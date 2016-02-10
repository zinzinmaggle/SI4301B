<?php
class AdministrationController extends Yaf\Controller_Abstract
{

    private $_layout;
    public function init()
    {
        $dispacher = Yaf\Dispatcher::getInstance();
        $layout = new LayoutPlugin("newbackend.phtml");
        $this->_layout = $layout;
        $dispacher->registerPlugin($layout);
        $translate = Yaf\Registry::get("translate");
        $this->_layout->meta_title = $translate->_('Counter-Strike : GO - Administration');

    }
    public function indexAction()
    {

        $request = $this->getRequest();
        if($request->isPost()){

            $pdo = PDOModel::GetInstance();
            $sub_id = $request->getPost("inputID");
            $entry = $request->getPost("inputAmount");
            $description = $request->getPost("inputDescription");
            $state = $request->getPost("inputState");
            $value = $request->getPost("inputPrice");

            //. $pdo->quote($request->inputID) .', '. $pdo->quote($_POST['inputAmount']) .', '. $pdo->quote($_POST['inputDescription']) .', '. $pdo->quote($_POST['inputState']) .', '. $pdo->quote($_POST['inputPrice']) .'
           /* if($pdo->query("INSERT  INTO Lotteries (sub_id,entry,starting_date,ending_date,item_description,item_state,item_value) VALUES ('$sub_id',$entry,'',null,'$description','$state','$value')"))
            {
                $this->redirect("/");
            }
            else
            {
                $this->redirect("/");
            }*/

        }
        $translate = Yaf\Registry::get("translate");
    }

    




}
