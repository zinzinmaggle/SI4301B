<?php

class TimezoneModel
{

    public static function GETALL()
    {
        $db = new PDOModel();
        return $db->query("SELECT * FROM TimeZone ORDER BY value DESC")->fetchAll();
    }

    public static function getDecalageByID($id)
    {
        $db = new PDOModel();
        return $db->query("SELECT value as val FROM TimeZone where id=$id")->fetch(PDO::FETCH_OBJ)->val;
    }

}
