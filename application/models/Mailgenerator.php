<?php

class MailgeneratorModel
{

    public static $_mandrill_api_key = "umlWXD-P1ID7u_04o6ii1g";
    public $html;
    public $subject;
    public $from_email;
    public $from_name = "";
    public $to = array();
    public $to_type = 'to';
    public $headers = array();
    public $important = false;
    public $track_opens = true;
    public $track_clicks = true;
    public $auto_text = true;
    public $inline_css = true;
    public $signing_domain = "";
    public $return_path_domain = "";
    public $tags = array();
    public $attachments = array();
    public $message;

    public function __construct()
    {
        $this->message['attachments'] = array();
    }

    public function build()
    {
        $this->message += array(
            'html' => $this->html,
            'subject' => $this->subject,
            'from_email' => $this->from_email,
            'from_name' => $this->from_name,
            'to' => $this->to,
            'headers' => $this->headers,
            'important' => $this->important,
            'track_opens' => true,
            'track_clicks' => true,
            'auto_text' => true,
            'auto_html' => true,
            'inline_css' => true,
            'signing_domain' => $this->signing_domain,
            'return_path_domain' => $this->signing_domain,
            'tags' => $this->tags
        );
        return $this;
    }

    public function Send()
    {
        $mandril = new Mandrill(MailgeneratorModel::$_mandrill_api_key);
        $r = $mandril->messages->send($this->message);
        return $r;
    }

}
