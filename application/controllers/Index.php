<?php

class IndexController extends Yaf\Controller_Abstract
{

    private $_layout;

    public function init()
    {

    }

    public function indexAction()
    {
        $all_maps = MapModel::getAllMap();
        if (count($all_maps) == 0) {
            $this->redirect("/Index/chairs");
        }
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("backend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_(' Meta Title');
        $this->_layout->css = '';
        $this->_layout->scripts = "<script src='/backend/assets/plugins/bootstrap-switch/static/js/bootstrap-switch.js'></script>".
            '<script src="/general/assets/js/Pages/Index/index.js"></script>';


    }

    public function chairsAction()
    {
        $translate = Yaf\Registry::get("translate");
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("backend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $this->_layout->meta_title = $translate->_(CUSTOMER_NAME . ' - MySeat');
        //$this->_layout->meta_title = $translate->_('Chairs') . ' | ' . $translate->_('Administration');
        $this->_layout->css = '<link rel="stylesheet" href="/backend/assets/plugins/DataTables/media/css/jquery.dataTables.css">' .
            '<link rel="stylesheet" href="/backend/assets/plugins/DataTables/media/css/jquery.dataTables_themeroller.css">' .
            '<link rel="stylesheet" href="/backend/assets/plugins/DataTables/media/css/DT_bootstrap.css">';
        $this->_layout->scripts = '<script src="/backend/assets/plugins/DataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>' .
            '<script src="/general/assets/js/Pages/Index/chairs.js"></script>';

    }



}
