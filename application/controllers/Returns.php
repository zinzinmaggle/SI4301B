<?php

class ReturnsController extends Yaf\Controller_Abstract
{

    private $_layout;

    public function init()
    {
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("newbackend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_('Counter-Strike : GO - Returns');

    }

    public function indexAction()
    {
        $pdo = PDOModel::GetInstance();
        $session = SessionModel::getInstance();

        $results = $pdo->query("SELECT * FROM Returns")->fetchAll(PDO::FETCH_OBJ);

        $this->_view->returns=$results;


        $request = $this->getRequest();
        $idl = $request->getPost("lotteryID");

        if($request->isPost() && $idl){

            $has_claimed= $pdo->query("SELECT has_claimed FROM Returns WHERE idSteamReturns = '$session->steamid' AND idLotterieReturns = $idl")->fetchAll(PDO::FETCH_OBJ);
            if($has_claimed)
            {
                if($has_claimed[0]->has_claimed == 0)
                {
                    if($pdo->query("UPDATE Returns SET has_claimed = 1 WHERE idSteamReturns = '$session->steamid' AND idLotterieReturns = $idl "))
                    {
                        if($pdo->query("INSERT INTO Reclamations (idLotterie,idSteam,hashname_steam) VALUES($idl,'$session->steamid','$session->steam_personaname')"))
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

            }
            else
            {
                $this->redirect("/Error");

            }

        }


        $translate = Yaf\Registry::get("translate");
    }


}
