<?php

class ModalGeneratorModel
{

    public $content = array();

    function __construct($title = '&nbsp;', $content = '&nbsp;', $buttons = '&nbsp;', $ui_id = false)
    {
        $translate = Yaf\Registry::get("translate");
        if (!$ui_id) {
            $ui_id = UUIDModel::v4();
        }
        $this->content['ui_id'] = $ui_id;
        $this->content['success'] = true;
        $this->content['title'] = $title;
        $this->content['content'] =$content;
        $this->content['buttons'] = "<button type='button' class='btn btn-default' data-dismiss='modal'>{$translate->_('Close')}</button>" . $buttons;
    }

    public function get()
    {
        return $this->content;
    }

    public function __set($name, $value)
    {
        $this->content[$name] = $value;
    }

}
