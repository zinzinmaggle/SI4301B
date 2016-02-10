<?php

class AuthentificationController extends Yaf\Controller_Abstract
{

    private $_layout;

    public function init()
    {

    }


    public function indexAction()
    {
        $request = Yaf\Controller_Abstract::getRequest();
        $session = SessionModel::getInstance();
        if ($session->has('me')) {
            $this->redirect("/");
        }
        if ($request->isPost()) {

        } else {

        }
    }


    public function forgotPasswordAction()
    {
        Yaf\Dispatcher::getInstance()->autoRender(false);
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        die(json_encode(UsersModel::ForgotPassword($this->getRequest()->getParam("email", ""))));
    }

    public function logoutAction()
    {
        Yaf\Dispatcher::getInstance()->autoRender(false);

        $redis = new Predis\Client(
            array(
                "scheme" => "tcp",
                "host" => "127.0.0.1",
                "port" => 6379,
            )
        );
        $session = SessionModel::getInstance();
        $session->set("me",new stdClass());
        $session->del("me");
        session_unset($session);
        $session->destroy();
        $this->redirect("/");
    }

}
