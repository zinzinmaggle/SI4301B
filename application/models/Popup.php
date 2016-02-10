<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Popup
 *
 * @author mouhcine
 */
class PopupModel
{

    public $success = false;
    public $text = "";
    public $title = "";
    public $type = "";
    public $extra = array();

    function __construct($success, $text, $title, $type)
    {
        $this->success = $success;
        $this->text = $text;
        $this->title = $title;
        $this->type = $type;
    }

    function get()
    {
        return array('success' => $this->success,
            'text' => $this->text,
            'title' => $this->title,
            'type' => $this->type,
            'extra' => $this->extra);
    }

    function __get($name)
    {
        return $this->extra[$name];
    }

    function __set($name, $value)
    {
        $this->extra[$name] = $value;
    }

}
