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
        $translate = Yaf\Registry::get("translate");
    }


}
