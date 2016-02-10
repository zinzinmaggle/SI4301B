<?php

class AjaxController extends Yaf\Controller_Abstract
{

    public $translate;
    public $request;

    public function init()
    {
        Yaf\Dispatcher::getInstance()->autoRender(FALSE);
        $this->translate = Yaf\Registry::get("translate");
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        $this->request = $this->getRequest();
        if (!$this->request->isPost()) {
            die(json_encode(array('type' => 'error', 'title' => $this->translate->_('Error'), 'text' => $this->translate->_('An error has occured, please try again.'))));
        }
    }

    public function getCustomersAction()
    {

    }




}
