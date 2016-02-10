<?php

class TranslationModel
{

    public static $languages_availble = array('en', 'fr', 'jp');
    public $_translate;

    function __construct($language = false)
    {
        $this->_translate = new Zend_Translate_Adapter_Gettext(array(
            'adapter' => 'gettext',
            'content' => APP_PATH . 'languages/en.mo',
            'locale' => 'en'
        ));
        $this->_translate->addTranslation(array(
            'adapter' => 'gettext',
            'content' => APP_PATH . 'languages/de.mo',
            'locale' => 'de'
        ));
        $this->_translate->addTranslation(array(
            'adapter' => 'gettext',
            'content' => APP_PATH . 'languages/fr.mo',
            'locale' => 'fr'
        ));
        $this->_translate->addTranslation(array(
            'adapter' => 'gettext',
            'content' => APP_PATH . 'languages/jp.mo',
            'locale' => 'jp'
        ));
        $lang = "";
        if ($language) {
            $lang = substr($language, 0, 2);
        } else
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            }
        $session = SessionModel::getInstance();
        if ($session->has('me') && isset($session->me['language']) && in_array($session->me['language'], TranslationModel::$languages_availble)) {
            $this->_translate->setLocale($session->me['language']);
            Yaf\Registry::set("language", $session->me['language']);
        } else {
            if (in_array($lang, TranslationModel::$languages_availble)) {
                $this->_translate->setLocale($lang);
                Yaf\Registry::set("language", $lang);
            } else {
                $this->_translate->setLocale("en");
                Yaf\Registry::set("language", "en");
            }
        }
    }

    public static function getLanguages()
    {
        $translate = Yaf\Registry::get("translate");
        $languages = array();
        $languages["en"] = $translate->_("English");
        $languages["fr"] = $translate->_("French");
        $languages["jp"] = $translate->_("Japanese");
        return $languages;
    }

}
