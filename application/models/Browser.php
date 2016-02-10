<?php

class BrowserModel
{
    private $props = array("Version" => "0.0.0",
        "Name" => "unknown",
        "Agent" => "unknown",
        "AllowsHeaderRedirect" => true);

    public function __Construct()
    {
        $browsers = array("firefox", "msie", "opera", "chrome", "safari",
            "mozilla", "seamonkey", "konqueror", "netscape",
            "gecko", "navigator", "mosaic", "lynx", "amaya",
            "omniweb", "avant", "camino", "flock", "aol");

        $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        foreach ($browsers as $browser) {
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)) {
                $this->Name = $match[1];
                $this->Version = $match[2];
                break;
            }
        }
        $this->AllowsHeaderRedirect = !($this->Name == "msie" && $this->Version < 7);
    }

    public function __Get($name)
    {
        if (!array_key_exists($name, $this->props)) {
            return "unknown";
        }
        return $this->props[$name];
    }

    public function __toString()
    {
        return $this->Name . " / " . $this->Version;
    }

}

