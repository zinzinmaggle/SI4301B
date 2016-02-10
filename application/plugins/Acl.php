<?php

class AclPlugin extends Yaf\Plugin_Abstract
{

    private $_acl = null;


    public function __construct(Zend_Acl $_acl)
    {
        $this->_acl = $_acl;
    }

    public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {
        $resource = $request->controller;
        $action = $request->action;
        Yaf\Registry::set("controller/action", $resource.'/'.$action);
        if (!$this->_acl->isAllowed(Yaf\Registry::get("role"), $resource, $action)) {
            $request->controller = 'Test';
            $request->action = 'index';
        } else {

        }
    }


    private function escapeArray(&$value)
    {
        if (is_array($value)) {
            foreach ($value as &$v) {
                $this->escapeArray($v);
            }
        } else {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }

    private function preventInjection(Yaf\Request_Abstract &$request)
    {

    }
}
