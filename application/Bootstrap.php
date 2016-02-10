<?php

class Bootstrap extends Yaf\Bootstrap_Abstract
{

    private $_config;
    private $_acl;
    private $_session;

    /* get a copy of the config */

    public function _initBootstrap()
    {


        $this->_session = SessionModel::getInstance();
        $this->_config = Yaf\Application::app()->getConfig();
        $translate = new TranslationModel();

        Yaf\Registry::set("translate", $translate->_translate);

    }

    /*
     * initIncludePath is only required because zend components have a shit load of
     * include_once calls everywhere. Other libraries could probably just use
     * the autoloader (see _initNamespaces below).
     */

    public function _initIncludePath()
    {

        set_include_path(get_include_path().PATH_SEPARATOR.$this->_config->application->library);

    }

    public function _initErrors()
    {
        if ($this->_config->application->showErrors) {
            error_reporting(E_ALL);
            error_reporting(1);
            ini_set('display_errors', 'On');

        }

    }

    public function _initNamespaces()
    {
        Yaf\Loader::getInstance()->registerLocalNameSpace(array("Zend", "Swift", "Predis", "Mandrill"));

    }

    public function _initRoutes()
    {

    }

    public function _initLayout(Yaf\Dispatcher $dispatcher)
    {
        $this->_acl = new AclModel();
        if ($this->_session->has('me') && !isset($this->_session->me['role'])) {
            $session = SessionModel::getInstance();
            $session->del("me");
            $session->destroy();
            Yaf\Registry::set("role", "guest");
        } else {
            if ($this->_session->has('me') && isset($this->_session->me['role'])) {
                Yaf\Registry::set("role", $this->_session->me['role']);
            } else {
                Yaf\Registry::set("role", "guest");
            }
        }

        $AclPlugin = new AclPlugin($this->_acl);
        $dispatcher->registerPlugin($AclPlugin);
    }

}
