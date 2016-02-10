<?php

class LanguagesModel
{

    public static function GET_LANGUAGES($all = false)
    {
        $translate = Yaf\Registry::get("translate");
        $languages = array();
        if ($all) {
            $languages[''] = $translate->_('All languages');
        }

        $languages["english"] = $translate->_("English");
        $languages["french"] = $translate->_("French");
        $languages["spanish"] = $translate->_("Spanish");
        $languages["deutsch"] = $translate->_("Deutsch");
        $languages["german"] = $translate->_("German");
        return $languages;
    }

}
