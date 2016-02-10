<?php

class TidycleanerModel
{

    public static function CleanHTML($string)
    {
        $config = array(
            'clean' => true,
            'drop-proprietary-attributes' => true,
            'output-xhtml' => true,
            'show-body-only' => true,
            'word-2000' => true,
            'wrap' => '0'
        );
        $tidy = new tidy();
        $tidy->parseString($string, $config, 'utf8');
        $tidy->cleanRepair();
        return tidy_get_output($tidy);
    }

    public static function CleanHTMLToText($string)
    {
        $string = strip_tags($string);
        $string = html_entity_decode($string);
        $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
        $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
        $string = preg_replace('(\n|\r|\t)', ' ', $string);
        $string = preg_replace('/\s\s+/', ' ', $string);
        return $string;
    }

}
