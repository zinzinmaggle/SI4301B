<?php

class TestController extends Yaf\Controller_Abstract
{

    private $_layout;

    public function init()
    {
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("newbackend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_('Qui veut gagner des skins ?');
    }


    public function indexAction()
    {
        $request = Yaf\Controller_Abstract::getRequest();
        $session = SessionModel::getInstance();
        if ($session->has('me')) {
            $this->redirect("/");
        }

    }


}
