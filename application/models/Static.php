<?php

class StaticModel
{

    public static function ConvertObjToArrayasc($objs, $value)
    {
        $return = array();
        $i = 0;
        if ($value == "temp") {
            foreach ($objs as $obj) {
                $return[$i++] = $obj->$value / 100;
            }
        } else {
            foreach ($objs as $obj) {
                $return[$i++] = (int)$obj->$value;
            }
        }

        return $return;
    }

    public static function ConvertObjToArray1($objs, $value)
    {
        $return = array();
        $i = 0;
        foreach ($objs as $obj) {
            $return[$i++] = $obj->$value;
        }

        return $return;
    }

    public static function ConvertObjToArray($objs, $id, $value)
    {
        $return = array();
        foreach ($objs as $obj) {
            $return[$obj->$id] = $obj->$value;
        }

        return $return;
    }

    public static function ConvertObjToMultiArray($objs, $values = array(), $integers = array())
    {
        $return = array();
        foreach ($objs as $obj) {
            $r = array();

            foreach ($values as $v) {
                if (in_array($v, $integers)) {
                    $r[$v] = $obj->$v * 1;
                } else {
                    $r[$v] = $obj->$v;
                }
            }
            $return[] = $r;
        }

        return $return;
    }

    public static function ConvertObjToMultiArrayWithKey($objs, $id, array $values = array(), $return = array())
    {
        foreach ($objs as $obj) {
            $return[$obj->$id] = array();
            foreach ($values as $v) {
                $return[$obj->$id][$v] = $obj->$v;
            }
        }

        return $return;
    }

    public static function  GenerateRandomString($length = 7)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }


    public
    static function encrypt(
        $string,
        $key = "Mouhcine"
    ) {
        $result = "";
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        $salt_string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789";
        $length = rand(1, 15);
        $salt = "";
//        for ($i = 0; $i <= $length; $i++) {
//            $salt .= substr($salt_string, rand(0, strlen($salt_string)), 1);
//        }
        $salt_length = strlen($salt);
        $end_length = strlen(strval($salt_length));

        return base64_encode($result.$salt.$salt_length.$end_length);
    }

    public static function decrypt($string, $key = "Mouhcine")
    {
        $result = "";
        $string = base64_decode($string);
        $end_length = intval(substr($string, -1, 1));
        $string = substr($string, 0, -1);
        $salt_length = intval(substr($string, $end_length * -1, $end_length));
        $string = substr($string, 0, $end_length * -1 + $salt_length * -1);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return $result;
    }

    public static function GetUserIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public static function GetBrowserAndIp()
    {
        $browser = new BrowserModel();

        return $browser." / ".self::GetUserIP();
    }

    public static function randomApiKey($size = 8)
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $size; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string
    }

    public static function GetUrlContent($url, array $params = array())
    {

        $ch = curl_init();
        $timeout = 5;
        if(!empty($params)){
            $url.="?";
        }
        foreach ($params as $k => &$v) {
            $url .= "$k=".urlencode($v)."&";
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);
        return $data;

    }


}
