<?php

class LayoutPlugin extends Yaf\Plugin_Abstract
{

    private $_layoutDir;
    private $_layoutFile;
    private $_layoutVars = array('scripts' => "", "css" => "", 'action' => "", 'controller' => "", 'id' => "");
    public $facebook_items = array('site_name' => "MySeat");

    public function __construct($layoutFile, $layoutDir = null)
    {
        $translate = Yaf\Registry::get("translate");
        $this->_layoutVars['desc'] = $translate->_("MySeat.Fr");
        $this->_layoutFile = $layoutFile;
        $this->_layoutDir = ($layoutDir) ? $layoutDir : APP_PATH . 'views/';
    }

    public function __set($name, $value)
    {
        $this->_layoutVars[$name] = $value;
    }

    public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

    public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

    public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {
        $this->controller = ucfirst($request->controller);
        $this->action = strtolower($request->action);

        /* get the body of the response */
        $body = $response->getBody();

        /* clear existing response */
        $response->clearBody();

        /* wrap it in the layout */
        $layout = new Yaf\View\Simple($this->_layoutDir);
        $layout->content = $body;
        $this->_layoutVars['fb'] .= "<meta property='og:url' content='" . Yaf\Registry::get("fullurl") . "' /><meta property='og:title' content='{$this->_layoutVars['meta_title']}' />";
        $layout->assign('layout', $this->_layoutVars);

        /* set the response to use the wrapped version of the content */
        $response->setBody($layout->render($this->_layoutFile));
    }

    public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

    public function preResponse(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

    public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

    public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
    {

    }

}
