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

        $results = $pdo->query("SELECT * FROM Lotteries")->fetchAll(PDO::FETCH_OBJ);

        $this->_view->result=$results;
        $translate = Yaf\Registry::get("translate");
    }




}
