<?php
function shutdown()
{
    exec("kill -9 " . getmypid());
}

register_shutdown_function('shutdown');

class WorkerModel
{
    private $pdo;
    private $type;

    public function __construct($type = "default")
    {
        set_time_limit(0);
        $this->pdo = new PDOModel();
        $this->type = $type;
    }

    public function GoDoIt()
    {
        if ($this->IsRunning()) {
            exit;
        } else {
            $this->DoIt();
        }
    }


    private function DoIt()
    {
        $this->pdo->query("INSERT INTO `PID` (`pid`, `type`,`start_date`) VALUES ('" . getmypid() . "', {$this->pdo->quote($this->type)},now());");
        while (true) {
            $this->GrabChanges();
            $this->ProcessAlerts();
            sleep(5);
        }
    }

    private function GrabChanges()
    {
        $customers = $this->pdo->query("SELECT id from `Customer`")->fetchAll(PDO::FETCH_OBJ);
        foreach ($customers as &$cust) {
            $s = new ServerslinkModel($cust->id);
            if ($s->_is_diff) {
                $s->GrabChanges();
            }
            ChairModel::UpdateChairsStatus($cust->id);
            ChairModel::UpdateChairsGateway($cust->id);
        }
    }

    private function ProcessAlerts()
    {
        $pdo = new PDOModel();
        $customers = $pdo->query("SELECT id from `Customer`")->fetchAll(PDO::FETCH_OBJ);
        foreach ($customers as &$cust) {
            $AlertModel = new AlertsModel($cust->id);
            $AlertModel->CheckNewAlerts();

            $AlertModel->SendNotifications();
//            $AlertModel->NotifyByEmail();

        }
    }

    private function IsRunning()
    {
        $proccess = $this->pdo->query("SELECT *,count(`id`) as c FROM `PID` WHERE `type` = {$this->pdo->quote($this->type)} AND `status`=1")->fetch(PDO::FETCH_OBJ);

        if ($proccess->c > 0) {
            if (!$this->processExists($proccess->pid)) {
                $this->pdo->query("UPDATE `PID` SET `end_date`=now() ,`status`=0  WHERE  `type` = {$this->pdo->quote($this->type)} AND `status`=1")->fetch(PDO::FETCH_OBJ);
                return $this->IsRunning();
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    private function processExists($pid)
    {
        return file_exists("/proc/{$pid}");
    }

}

