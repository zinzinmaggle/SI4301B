<?php
class LotteryController extends Yaf\Controller_Abstract
{

    private $_layout;
    public function init()
    {
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("newbackend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_('Counter-Strike : GO - Lottery');

    }
    public function indexAction()
    {
        $pdo = PDOModel::GetInstance();
        $session = SessionModel::getInstance();

        $results = $pdo->query("SELECT * FROM Lotteries WHERE lottery_ended = 0")->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $lottery) {

            $lottery->test = $pdo->query("SELECT COUNT(idLotterieParticipation) AS Total,idLotterieParticipation FROM Participations WHERE idLotterieParticipation = $lottery->sub_id GROUP BY idLotterieParticipation")->fetchAll(PDO::FETCH_OBJ);
        }



        $this->_view->lottery=$results;


        $request = $this->getRequest();

        $idl = $request->getPost("lotteryID");
        $t = time();

        if($request->isPost()){
          //  $condition = $pdo->query("SELECT derniereParticipation FROM Participations WHERE idSteamParticipant = '$session->steamid' AND idLotterieParticipation = $idl ORDER BY derniereParticipation DESC LIMIT 1")->fetchAll(PDO::FETCH_OBJ);
          //  $now= time();
          //  if($now < $condition[0]->derniereParticipation+(24*3600))
          //  {
          //      $this->redirect("/Error");
          //  }
          //  else
          //  {

                $current_entry =  $pdo->query("SELECT COUNT(idLotterieParticipation) AS Total,idLotterieParticipation FROM Participations WHERE idLotterieParticipation = $idl GROUP BY idLotterieParticipation")->fetchAll(PDO::FETCH_OBJ);
                $maximum_entry = $pdo->query("SELECT entry FROM Lotteries WHERE sub_id = $idl")->fetchAll(PDO::FETCH_OBJ);

               if($current_entry[0]->Total < ($maximum_entry[0]->entry)-1)
                {
                    if($pdo->query("INSERT INTO Participations (idSteamParticipant,idLotterieParticipation,hashnameParticipant,derniereParticipation) VALUES ('$session->steamid',$idl,'$session->steam_personaname',$t)"))
                    {
                        $this->redirect("/Lottery");
                    }
                    else
                    {
                        $this->redirect("/Error");
                    }
                }
                else
                {
                    if($pdo->query("UPDATE Lotteries SET lottery_ended = 1 WHERE sub_id = $idl"))
                    {
                        //tirer un mec aléatoirement
                        $random_i = rand(0,$current_entry[0]->Total);
                        $all_entry = $pdo->query("SELECT idSteamParticipant,hashnameParticipant FROM Participations WHERE idLotterieParticipation = $idl")->fetchAll(PDO::FETCH_OBJ);
                        $id_gagnant = $all_entry[$random_i]->idSteamParticipant;
                        $hashname_gagnant = $all_entry[$random_i]->hashnameParticipant;

                        //récupération du prix gagné pour l'insérer dans la table des retours

                        $price = $pdo->query("SELECT item_description, item_state FROM Lotteries WHERE sub_id = $idl")->fetchAll(PDO::FETCH_OBJ);
                        $concat_price = $price[0]->item_description . ' ('.$price[0]->item_state.')';
                        if($pdo->query("INSERT INTO Returns (idLotterieReturns, idSteamReturns,hashname_winner,concat_price) VALUES ($idl,'$id_gagnant','$hashname_gagnant','$concat_price')"))
                        {
                            $this->redirect("/Returns");
                        }
                        else
                        {
                            $this->redirect("/Error");
                        }
                    }
                    else
                    {
                        $this->redirect("/Error");
                    }


                }
           //}

        }

        $translate = Yaf\Registry::get("translate");
    }




}
