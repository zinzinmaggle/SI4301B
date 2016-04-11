<?php
class AdministrationController extends Yaf\Controller_Abstract
{

    private $_layout;
    public function init()
    {
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("newbackend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_('QVGDS - Administration');

    }
    public function indexAction()
    {
        $pdo = PDOModel::GetInstance();
        $request = $this->getRequest();
        $session = SessionModel::getInstance();

        if($session->steam_steamid != "76561198078265100" && $session->steam_steamid != "76561198041856215")
        {
            $this->redirect("/Error");
        }

        $results = $pdo->query("SELECT * FROM Lotteries")->fetchAll(PDO::FETCH_OBJ);

        $claims = $pdo->query("SELECT * FROM Reclamations")->fetchAll(PDO::FETCH_OBJ);

        $GLOBAL[] = $results;
        array_push($GLOBAL,$claims);

        $this->_view->administration=$GLOBAL;





        if($request->isPost()){

            $pdo = PDOModel::GetInstance();
            $sub_id = $request->getPost("inputID");
            $entry = $request->getPost("inputAmount");
            $description = $request->getPost("inputDescription");
            $state = $request->getPost("inputState");
            $value = $request->getPost("inputPrice");
            $imageurl = $request->getPost("inputImageUrl");


            $remove_lottery_before = $request->getPost("inputLotterie");
            $validate_claim = $request->getPost("idlotterie");

            if(isset($sub_id) && isset($entry) && isset($description) && isset($state) && isset($value))
            {
                $date = new DateTime();
                $current_date = $date->getTimestamp();
                if($pdo->query("INSERT INTO Lotteries (sub_id,entry,starting_date,ending_date,item_description,item_state,item_value,imageurl,lottery_ended) VALUES ('$sub_id',$entry, $current_date,null,'$description','$state','$value','$imageurl',0)"))
                {
                    $this->redirect("/Lottery");
                }
                else
                {
                    $this->redirect("/Administration");
                }
            }
            else if(isset($validate_claim))
            {
                if($pdo->query("UPDATE Reclamations SET validate = 1 WHERE idLotterie = $validate_claim"))
                {
                    $this->redirect("/Administration");

                }
                else
                {
                    $this->redirect("/Error");

                }
            }
            else {
                $remove_lottery = (int)$remove_lottery_before;

                if($pdo->query("DELETE FROM Lotteries WHERE sub_id = $remove_lottery") && $pdo->query("DELETE FROM Participations WHERE idLotterieParticipation = $remove_lottery") && $pdo->query("DELETE FROM Returns WHERE idLotterieReturns = $remove_lottery"))
                {
                    $this->redirect("/Administration");

                }
                else
                {
                    $this->redirect("/Error");
                }

            }

        }
        $translate = Yaf\Registry::get("translate");
    }

    




}
