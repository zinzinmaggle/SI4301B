<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Date
 *
 * @author mouhcine
 */
class DateModel
{

    public static $months = array("fr" => array('months_short' => array('Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'),
        'months_long' => array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre')));


    public static function ConvertDateInbox($sql_date)
    {

        $str_date = strtotime($sql_date);
        if (date('Y-m-d') == date('Y-m-d', $str_date)) {
            return date('H:i', $str_date);
        } else {
            return date('M d', $str_date);
        }
    }

    public static function ConvertDateInboxChat($sql_date)
    {
        $str_date = strtotime($sql_date);
        return date('g:i A', $str_date);
    }

    public static function ConvertDateInboxChatDay($sql_date)
    {
        $str_date = strtotime($sql_date);
        return date("l, j F, Y", $str_date);
    }

    public static function ConvertDateInboxNextPayment($sql_date)
    {
        $str_date = strtotime($sql_date);
        return date("j F Y", $str_date);
    }

    public static function ConvertFormat($format1, $format2, $date)
    {
        $myDateTime = DateTime::createFromFormat($format1, $date);
        if ($myDateTime) {
            return $myDateTime->format($format2);
        } else {
            return "";
        }
    }

    public static function ConvertFormatTextSQL($format, $date)
    {
        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $myDateTime->format($format);
    }

    public static function time_elapsed_string($ptime)
    {
        $translate = Yaf\Registry::get("translate");
        $etime = time() - $ptime;
        if ($etime < 1) {
            return "0 " . $translate->_('second');
        }

        $a = array(12 * 30 * 24 * 60 * 60 => $translate->_('year'),
            30 * 24 * 60 * 60 => $translate->_('month'),
            24 * 60 * 60 => $translate->_('day'),
            60 * 60 => $translate->_('hour'),
            60 => $translate->_('minute'),
            1 => $translate->_('second')
        );
        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . $translate->_(' ago');
            }
        }
    }

    public static function Expire_in($ptime)
    {
        $etime = $ptime - time();
        if ($etime < 1) {
            return round($etime / (24 * 3600));
        } else {
            return round($etime / (24 * 3600));
        }
    }

    public static function diffTwoDates($ptime1, $ptime2)
    {
        $etime = ($ptime1 - $ptime2) > 0 ? $ptime1 - $ptime2 : $ptime2 - $ptime1;
        return ceil($etime / (24 * 3600));
    }

    public static function IsSupMysql($ptime1)
    {
        return (strtotime($ptime1) > time());
    }

    public static function getTimeZones()
    {
        $timezone = array();
        $timezone["Europe/Amsterdam"] = "Europe/Amsterdam";
        $timezone["Europe/Andorra"] = "Europe/Andorra";
        $timezone["Europe/Athens"] = "Europe/Athens";
        $timezone["Europe/Belfast"] = "Europe/Belfast";
        $timezone["Europe/Belgrade"] = "Europe/Belgrade";
        $timezone["Europe/Berlin"] = "Europe/Berlin";
        $timezone["Europe/Bratislava"] = "Europe/Bratislava";
        $timezone["Europe/Brussels"] = "Europe/Brussels";
        $timezone["Europe/Bucharest"] = "Europe/Bucharest";
        $timezone["Europe/Budapest"] = "Europe/Budapest";
        $timezone["Europe/Busingen"] = "Europe/Busingen";
        $timezone["Europe/Chisinau"] = "Europe/Chisinau";
        $timezone["Europe/Copenhagen"] = "Europe/Copenhagen";
        $timezone["Europe/Dublin"] = "Europe/Dublin";
        $timezone["Europe/Gibraltar"] = "Europe/Gibraltar";
        $timezone["Europe/Guernsey"] = "Europe/Guernsey";
        $timezone["Europe/Helsinki"] = "Europe/Helsinki";
        $timezone["Europe/Isle_of_Man"] = "Europe/Isle_of_Man";
        $timezone["Europe/Istanbul"] = "Europe/Istanbul";
        $timezone["Europe/Jersey"] = "Europe/Jersey";
        $timezone["Europe/Kaliningrad"] = "Europe/Kaliningrad";
        $timezone["Europe/Kiev"] = "Europe/Kiev";
        $timezone["Europe/Lisbon"] = "Europe/Lisbon";
        $timezone["Europe/Ljubljana"] = "Europe/Ljubljana";
        $timezone["Europe/London"] = "Europe/London";
        $timezone["Europe/Luxembourg"] = "Europe/Luxembourg";
        $timezone["Europe/Madrid"] = "Europe/Madrid";
        $timezone["Europe/Malta"] = "Europe/Malta";
        $timezone["Europe/Mariehamn"] = "Europe/Mariehamn";
        $timezone["Europe/Minsk"] = "Europe/Minsk";
        $timezone["Europe/Monaco"] = "Europe/Monaco";
        $timezone["Europe/Moscow"] = "Europe/Moscow";
        $timezone["Europe/Nicosia"] = "Europe/Nicosia";
        $timezone["Europe/Oslo"] = "Europe/Oslo";
        $timezone["Europe/Paris"] = "Europe/Paris";
        $timezone["Europe/Podgorica"] = "Europe/Podgorica";
        $timezone["Europe/Prague"] = "Europe/Prague";
        $timezone["Europe/Riga"] = "Europe/Riga";
        $timezone["Europe/Rome"] = "Europe/Rome";
        $timezone["Europe/Samara"] = "Europe/Samara";
        $timezone["Europe/San_Marino"] = "Europe/San_Marino";
        $timezone["Europe/Sarajevo"] = "Europe/Sarajevo";
        $timezone["Europe/Simferopol"] = "Europe/Simferopol";
        $timezone["Europe/Skopje"] = "Europe/Skopje";
        $timezone["Europe/Sofia"] = "Europe/Sofia";
        $timezone["Europe/Stockholm"] = "Europe/Stockholm";
        $timezone["Europe/Tallinn"] = "Europe/Tallinn";
        $timezone["Europe/Tirane"] = "Europe/Tirane";
        $timezone["Europe/Tiraspol"] = "Europe/Tiraspol";
        $timezone["Europe/Uzhgorod"] = "Europe/Uzhgorod";
        $timezone["Europe/Vaduz"] = "Europe/Vaduz";
        $timezone["Europe/Vatican"] = "Europe/Vatican";
        $timezone["Europe/Vienna"] = "Europe/Vienna";
        $timezone["Europe/Vilnius"] = "Europe/Vilnius";
        $timezone["Europe/Volgograd"] = "Europe/Volgograd";
        $timezone["Europe/Warsaw"] = "Europe/Warsaw";
        $timezone["Europe/Zagreb"] = "Europe/Zagreb";
        $timezone["Europe/Zaporozhye"] = "Europe/Zaporozhye";
        $timezone["Europe/Zurich"] = "Europe/Zurich";
        $timezone[" America/Adak"] = " America/Adak";
        $timezone["America/Anchorage"] = "America/Anchorage";
        $timezone["America/Anguilla"] = "America/Anguilla";
        $timezone["America/Antigua"] = "America/Antigua";
        $timezone["America/Araguaina"] = "America/Araguaina";
        $timezone["America/Argentina/Buenos_Aires"] = "America/Argentina/Buenos_Aires";
        $timezone["America/Argentina/Catamarca"] = "America/Argentina/Catamarca";
        $timezone["America/Argentina/ComodRivadavia"] = "America/Argentina/ComodRivadavia";
        $timezone["America/Argentina/Cordoba"] = "America/Argentina/Cordoba";
        $timezone["America/Argentina/Jujuy"] = "America/Argentina/Jujuy";
        $timezone["America/Argentina/La_Rioja"] = "America/Argentina/La_Rioja";
        $timezone["America/Argentina/Mendoza"] = "America/Argentina/Mendoza";
        $timezone["America/Argentina/Rio_Gallegos"] = "America/Argentina/Rio_Gallegos";
        $timezone["America/Argentina/Salta"] = "America/Argentina/Salta";
        $timezone["America/Argentina/San_Juan"] = "America/Argentina/San_Juan";
        $timezone["America/Argentina/San_Luis"] = "America/Argentina/San_Luis";
        $timezone["America/Argentina/Tucuman"] = "America/Argentina/Tucuman";
        $timezone["America/Argentina/Ushuaia"] = "America/Argentina/Ushuaia";
        $timezone["America/Aruba"] = "America/Aruba";
        $timezone["America/Asuncion"] = "America/Asuncion";
        $timezone["America/Atikokan"] = "America/Atikokan";
        $timezone["America/Atka"] = "America/Atka";
        $timezone["America/Bahia"] = "America/Bahia";
        $timezone["America/Bahia_Banderas"] = "America/Bahia_Banderas";
        $timezone["America/Barbados"] = "America/Barbados";
        $timezone["America/Belem"] = "America/Belem";
        $timezone["America/Belize"] = "America/Belize";
        $timezone["America/Blanc-Sablon"] = "America/Blanc-Sablon";
        $timezone["America/Boa_Vista"] = "America/Boa_Vista";
        $timezone["America/Bogota"] = "America/Bogota";
        $timezone["America/Boise"] = "America/Boise";
        $timezone["America/Buenos_Aires"] = "America/Buenos_Aires";
        $timezone["America/Cambridge_Bay"] = "America/Cambridge_Bay";
        $timezone["America/Campo_Grande"] = "America/Campo_Grande";
        $timezone["America/Cancun"] = "America/Cancun";
        $timezone["America/Caracas"] = "America/Caracas";
        $timezone["America/Catamarca"] = "America/Catamarca";
        $timezone["America/Cayenne"] = "America/Cayenne";
        $timezone["America/Cayman"] = "America/Cayman";
        $timezone["America/Chicago"] = "America/Chicago";
        $timezone["America/Chihuahua"] = "America/Chihuahua";
        $timezone["America/Coral_Harbour"] = "America/Coral_Harbour";
        $timezone["America/Cordoba"] = "America/Cordoba";
        $timezone["America/Costa_Rica"] = "America/Costa_Rica";
        $timezone["America/Creston"] = "America/Creston";
        $timezone["America/Cuiaba"] = "America/Cuiaba";
        $timezone["America/Curacao"] = "America/Curacao";
        $timezone["America/Danmarkshavn"] = "America/Danmarkshavn";
        $timezone["America/Dawson"] = "America/Dawson";
        $timezone["America/Dawson_Creek"] = "America/Dawson_Creek";
        $timezone["America/Denver"] = "America/Denver";
        $timezone["America/Detroit"] = "America/Detroit";
        $timezone["America/Dominica"] = "America/Dominica";
        $timezone["America/Edmonton"] = "America/Edmonton";
        $timezone["America/Eirunepe"] = "America/Eirunepe";
        $timezone["America/El_Salvador"] = "America/El_Salvador";
        $timezone["America/Ensenada"] = "America/Ensenada";
        $timezone["America/Fort_Wayne"] = "America/Fort_Wayne";
        $timezone["America/Fortaleza"] = "America/Fortaleza";
        $timezone["America/Glace_Bay"] = "America/Glace_Bay";
        $timezone["America/Godthab"] = "America/Godthab";
        $timezone["America/Goose_Bay"] = "America/Goose_Bay";
        $timezone["America/Grand_Turk"] = "America/Grand_Turk";
        $timezone["America/Grenada"] = "America/Grenada";
        $timezone["America/Guadeloupe"] = "America/Guadeloupe";
        $timezone["America/Guatemala"] = "America/Guatemala";
        $timezone["America/Guayaquil"] = "America/Guayaquil";
        $timezone["America/Guyana"] = "America/Guyana";
        $timezone["America/Halifax"] = "America/Halifax";
        $timezone["America/Havana"] = "America/Havana";
        $timezone["America/Hermosillo"] = "America/Hermosillo";
        $timezone["America/Indiana/Indianapolis"] = "America/Indiana/Indianapolis";
        $timezone["America/Indiana/Knox"] = "America/Indiana/Knox";
        $timezone["America/Indiana/Marengo"] = "America/Indiana/Marengo";
        $timezone["America/Indiana/Petersburg"] = "America/Indiana/Petersburg";
        $timezone["America/Indiana/Tell_City"] = "America/Indiana/Tell_City";
        $timezone["America/Indiana/Vevay"] = "America/Indiana/Vevay";
        $timezone["America/Indiana/Vincennes"] = "America/Indiana/Vincennes";
        $timezone["America/Indiana/Winamac"] = "America/Indiana/Winamac";
        $timezone["America/Indianapolis"] = "America/Indianapolis";
        $timezone["America/Inuvik"] = "America/Inuvik";
        $timezone["America/Iqaluit"] = "America/Iqaluit";
        $timezone["America/Jamaica"] = "America/Jamaica";
        $timezone["America/Jujuy"] = "America/Jujuy";
        $timezone["America/Juneau"] = "America/Juneau";
        $timezone["America/Kentucky/Louisville"] = "America/Kentucky/Louisville";
        $timezone["America/Kentucky/Monticello"] = "America/Kentucky/Monticello";
        $timezone["America/Knox_IN"] = "America/Knox_IN";
        $timezone["America/Kralendijk"] = "America/Kralendijk";
        $timezone["America/La_Paz"] = "America/La_Paz";
        $timezone["America/Lima"] = "America/Lima";
        $timezone["America/Los_Angeles"] = "America/Los_Angeles";
        $timezone["America/Louisville"] = "America/Louisville";
        $timezone["America/Lower_Princes"] = "America/Lower_Princes";
        $timezone["America/Maceio"] = "America/Maceio";
        $timezone["America/Managua"] = "America/Managua";
        $timezone["America/Manaus"] = "America/Manaus";
        $timezone["America/Marigot"] = "America/Marigot";
        $timezone["America/Martinique"] = "America/Martinique";
        $timezone["America/Matamoros"] = "America/Matamoros";
        $timezone["America/Mazatlan"] = "America/Mazatlan";
        $timezone["America/Mendoza"] = "America/Mendoza";
        $timezone["America/Menominee"] = "America/Menominee";
        $timezone["America/Merida"] = "America/Merida";
        $timezone["America/Metlakatla"] = "America/Metlakatla";
        $timezone["America/Mexico_City"] = "America/Mexico_City";
        $timezone["America/Miquelon"] = "America/Miquelon";
        $timezone["America/Moncton"] = "America/Moncton";
        $timezone["America/Monterrey"] = "America/Monterrey";
        $timezone["America/Montevideo"] = "America/Montevideo";
        $timezone["America/Montreal"] = "America/Montreal";
        $timezone["America/Montserrat"] = "America/Montserrat";
        $timezone["America/Nassau"] = "America/Nassau";
        $timezone["America/New_York"] = "America/New_York";
        $timezone["America/Nipigon"] = "America/Nipigon";
        $timezone["America/Nome"] = "America/Nome";
        $timezone["America/Noronha"] = "America/Noronha";
        $timezone["America/North_Dakota/Beulah"] = "America/North_Dakota/Beulah";
        $timezone["America/North_Dakota/Center"] = "America/North_Dakota/Center";
        $timezone["America/North_Dakota/New_Salem"] = "America/North_Dakota/New_Salem";
        $timezone["America/Ojinaga"] = "America/Ojinaga";
        $timezone["America/Panama"] = "America/Panama";
        $timezone["America/Pangnirtung"] = "America/Pangnirtung";
        $timezone["America/Paramaribo"] = "America/Paramaribo";
        $timezone["America/Phoenix"] = "America/Phoenix";
        $timezone["America/Port-au-Prince"] = "America/Port-au-Prince";
        $timezone["America/Port_of_Spain"] = "America/Port_of_Spain";
        $timezone["America/Porto_Acre"] = "America/Porto_Acre";
        $timezone["America/Porto_Velho"] = "America/Porto_Velho";
        $timezone["America/Puerto_Rico"] = "America/Puerto_Rico";
        $timezone["America/Rainy_River"] = "America/Rainy_River";
        $timezone["America/Rankin_Inlet"] = "America/Rankin_Inlet";
        $timezone["America/Recife"] = "America/Recife";
        $timezone["America/Regina"] = "America/Regina";
        $timezone["America/Resolute"] = "America/Resolute";
        $timezone["America/Rio_Branco"] = "America/Rio_Branco";
        $timezone["America/Rosario"] = "America/Rosario";
        $timezone["America/Santa_Isabel"] = "America/Santa_Isabel";
        $timezone["America/Santarem"] = "America/Santarem";
        $timezone["America/Santiago"] = "America/Santiago";
        $timezone["America/Santo_Domingo"] = "America/Santo_Domingo";
        $timezone["America/Sao_Paulo"] = "America/Sao_Paulo";
        $timezone["America/Scoresbysund"] = "America/Scoresbysund";
        $timezone["America/Shiprock"] = "America/Shiprock";
        $timezone["America/Sitka"] = "America/Sitka";
        $timezone["America/St_Barthelemy"] = "America/St_Barthelemy";
        $timezone["America/St_Johns"] = "America/St_Johns";
        $timezone["America/St_Kitts"] = "America/St_Kitts";
        $timezone["America/St_Lucia"] = "America/St_Lucia";
        $timezone["America/St_Thomas"] = "America/St_Thomas";
        $timezone["America/St_Vincent"] = "America/St_Vincent";
        $timezone["America/Swift_Current"] = "America/Swift_Current";
        $timezone["America/Tegucigalpa"] = "America/Tegucigalpa";
        $timezone["America/Thule"] = "America/Thule";
        $timezone["America/Thunder_Bay"] = "America/Thunder_Bay";
        $timezone["America/Tijuana"] = "America/Tijuana";
        $timezone["America/Toronto"] = "America/Toronto";
        $timezone["America/Tortola"] = "America/Tortola";
        $timezone["America/Vancouver"] = "America/Vancouver";
        $timezone["America/Virgin"] = "America/Virgin";
        $timezone["America/Whitehorse"] = "America/Whitehorse";
        $timezone["America/Winnipeg"] = "America/Winnipeg";
        $timezone["America/Yakutat"] = "America/Yakutat";
        $timezone["America/Yellowknife"] = "America/Yellowknife";
        return $timezone;
    }

    public static function PickAchivedTime($date)
    {
        $translate = Yaf\Registry::get("translate");
        if ($date) {
            switch (Yaf\Registry::get("language")) {
                case "en":
                    return "Achieved The " . date_format($date, "j") . " " . date_format($date, "M") . " " . date_format($date, "Y") . " at " . date_format($date, "h.i a ");
                case "fr":
                    return "Atteint le " . date_format($date, "j") . " " . date_format($date, "M") . " " . date_format($date, "Y") . " à " . date_format($date, "H:i");
                default:
                    return "Achieved The " . date_format($date, "j") . " " . date_format($date, "M") . " " . date_format($date, "Y") . " at " . date_format($date, "h.i a ");
            }
        } else {
            return $translate->_("- Never -");
        }
    }

    public static function TitleFromTo(DateTime $from, DateTime $to)
    {

        $translate = Yaf\Registry::get("translate");
        if ($from) {
            switch (Yaf\Registry::get("language")) {
                case "en":
                    return "From " . $from->format("j") . " " . $from->format("M") . " " . $from->format("Y") . " to " . $to->format("j") . " " . $to->format("M") . " " . $to->format("Y");
                case "fr":
                    return "Du " . $from->format("j") . " " . self::$months['fr']['months_short'][$from->format("n") - 1] . " " . $from->format("Y") . " au " . $to->format("j") . " " . $to->format("M") . " " . $to->format("Y");
                case "jp":
                    return $from->format("Y")."年".$from->format("n")."月".$from->format("j")."日に".$from->format("Y")."年".$from->format("n")."月".$from->format("j")."日から、";
                default:
                    return "From " . $from->format("j") . " " . $from->format("M") . " " . $from->format("Y") . " to " . $to->format("j") . " " . $to->format("M") . " " . $to->format("Y");
            }
//            2015年3月25日に2015年3月23日から、
        } else {
            return $translate->_("-");
        }
    }



}
