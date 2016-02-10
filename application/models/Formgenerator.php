<?php

class FormgeneratorModel
{

    public $html;
    public $title;
    public $param;
    public $action;
    public $method;
    public $type;
    public $label_size = 3;
    public $input_size = 9;
    public $class;
    public $sons_class;
    public $elements = array();
    public $uuid = false;
    public $content;

    /***************
     * FormGeneratorModel()
     * {}
     ***************/

    function __construct($title = "", $type = 'form-horizontal', $class = '', $sons_class = '', $param = "", $action = "", $method = "POST", $uuid = false)
    {
        $this->title = $title;
        $this->param = $param;
        $this->action = $action;
        $this->type = $type;
        $this->method = $method;
        $this->class = $class;
        $this->sons_class = $sons_class;

        if ($uuid) {
            $this->uuid = UUIDModel::v4();
        }
    }

    function BuildIT()
    {
        $this->html = "<form class='{$this->type} {$this->class}' role='form' id='{$this->param}' action='{$this->action}' id_widget='{$this->uuid}' method='{$this->method}'>";

        $this->html .= $this->BuildLight()->content;


        $session = SessionModel::getInstance();
        if ($session->has("me") && $session->me['role'] != "guest") {
            $this->html .= PHP_EOL . "<input name='b_id' type='hidden' value='u_{$session->me['id_hash']}'>";
            $this->html .= PHP_EOL . "<input name='b_id_em' type='hidden' value='{$session->me['id_token']}'>";
        }
        $this->html .= "</form>";
        return $this;
    }


    function BuildLight()
    {
        $this->content = "";
        foreach ($this->elements as $element) {
            $element->build($this->label_size, $this->input_size, $this->sons_class);
            $this->content .= $element->html;
        }
        return $this;
    }


}

abstract class FormElement
{

    public $extra;
    public $html;
    public $label;
    public $param;
    public $value;
    public $class;
    public $placeholder;

    public abstract function build($label_size, $element_size, $sons_class);
}

class Button extends FormElement
{

    public $type, $onclick;

    function __construct($type, $title, $param, $class = "", $onclick = "")
    {
        $this->type = $type;
        $this->label = $title;
        $this->param = $param;
        $this->class = " " . $class . " ";
        $this->onclick = $onclick;
    }

    public function build($label_size, $element_size, $sons_class)
    {
        if ($this->type == "a") {

            $this->html = '<a class="btn btn-squared ' . $this->class . ' ' . $sons_class . '" id="' . $this->param . '" href="' . $this->onclick . '">' . htmlspecialchars($this->label) . '</a>';


        } else {


            $this->html = "<button type='{$this->type}' class='btn btn-squared {$this->class} $sons_class' id='{$this->param}' onclick='{$this->onclick}'>
            {$this->label}
                </button>";
        }
    }

}

class Input extends FormElement
{

    public $input_div_class = "";
    public $input_div_end_html = "";

    function __construct($label, $param, $placeholder = "", $class = "", $value = "", $extra = "")
    {
        $this->label = $label;
        $this->param = $param;
        $this->value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        $this->class = " " . $class . " ";
        $this->placeholder = $placeholder;
        $this->extra = $extra;
    }

    public function build($label_size, $element_size, $sons_class)
    {
        $this->html = "<div class='form-group'>
        <label for='form-field-1' class='col-sm-$label_size control-label'>
            {$this->label}
        </label>
        <div class='col-sm-$element_size {$this->input_div_class}'>";
        $this->buildLight($sons_class);
        $this->html .= htmlspecialchars($this->input_div_end_html, ENT_QUOTES, 'UTF-8') . "
        </div>
    </div>";
    }

    public function buildLight($sons_class)
    {
        $this->html .= "<input {$this->extra} type='text' class='form-control {$this->class} $sons_class' id='{$this->param}' name='{$this->param}' placeholder=\"{$this->placeholder}\" value='{$this->value}'>";
    }

}

class TextArea extends FormElement
{

    public $input_div_class = "";
    public $input_div_end_html = "";

    function __construct($label, $param, $placeholder = "", $class = "", $value = "")
    {
        $this->label = $label;
        $this->param = $param;
        $this->value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        $this->class = " " . $class . " ";
        $this->placeholder = $placeholder;
    }

    public function build($label_size, $element_size, $sons_class)
    {
        $this->html = "<div class='form-group'>
        <label for='form-field-1' class='col-sm-$label_size control-label'>
            {$this->label}
        </label>
        <div class='col-sm-$element_size {$this->input_div_class}'>";
        $this->buildLight($sons_class);
        $this->html .= "
                {$this->input_div_end_html}
        </div>
    </div>";
    }

    public function buildLight($sons_class)
    {
        $this->html .= "<textarea type='text' rows='9' class='form-control {$this->class} $sons_class' name='{$this->param}' id='{$this->param}' placeholder=\"{$this->placeholder}\" >{$this->value}</textarea>";
    }

}

class Select extends FormElement
{

    public $values;
    public $allow_empty = false;

    function __construct($label, $param, $class = "", $values = array(), $value = "", $allow_empty = false, $extra = "")
    {
        $this->label = $label;
        $this->param = $param;
        $this->value = $value;
        $this->values = $values;
        $this->class = " " . $class . " ";
        if ($allow_empty) {
            if ($allow_empty && strlen($allow_empty) < 1) {
                $translate = Yaf\Registry::get("translate");
                $this->allow_empty .= $translate->_("-- select --");
            } else {
                $this->allow_empty .= $allow_empty;
            }
        }

        $this->extra = $extra;
    }

    public function build($label_size, $element_size, $sons_class)
    {
        $this->html = "<div class='form-group' {$this->extra}>
        <label for='form-field-1' class='col-sm-$label_size control-label'>
            {$this->label}
        </label>
        <div class='col-sm-$element_size'> ";
        $this->buildLight($sons_class);
        $this->html .= "
        </div>
    </div>";
    }

    public function buildLight($sons_class)
    {

        $this->html .= "<select class='form-control {$this->class} $sons_class' id='{$this->param}'  value='{$this->value}' name='{$this->param}'>";
        if ($this->allow_empty) {

            $this->html .= "<option value='0'>" . $this->allow_empty . "</option>";
        }
        foreach ($this->values as $key => $value) {
            if ($key == $this->value) {
                $this->html .= "<option selected value='{$key}'>{$value}</option>";
            } else {
                $this->html .= "<option value='{$key}'>{$value}</option>";
            }
        }
        $this->html .= "</select>";
    }

}

class SelectMultiple extends FormElement
{

    public $values;

    function __construct($label, $param, $class = "", $values = array(), $values_selected = array())
    {
        $this->label = $label;
        $this->param = $param;
        $this->values_selected = is_array($values_selected) ? $values_selected : array();
        $this->values = $values;
        $this->class = " " . $class . " ";
    }

    public function build($label_size, $element_size, $sons_class)
    {
        $this->html = "<div class='form-group'>
        <label for='form-field-1' class='col-sm-$label_size control-label'>
            {$this->label}
        </label>
        <div class='col-sm-$element_size'>";
        $this->buildLight($sons_class);
        $this->html .= "
        </div>
    </div>";
    }

    public function buildLight($sons_class)
    {
        $this->html .= "
            <select multiple='multiple' class='form-control {$this->class} $sons_class' id='{$this->param}'  value='{$this->value}' name='{$this->param}'>
            ";
        foreach ($this->values as $key => $value) {
            if (in_array($key, $this->values_selected)) {
                $this->html .= "<option selected value='{$key}'>{$value}</option>";
            } else {
                $this->html .= "<option value='{$key}'>{$value}</option>";
            }
        }
        $this->html .= "</select>";
    }

}

class extraContent
{

    public $html = "";

    public function __construct($content)
    {
        $this->html = $content;
    }

    public function build($label_size, $element_size, $sons_class)
    {

    }

}
