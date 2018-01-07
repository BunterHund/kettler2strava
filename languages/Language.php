<?php

class Language {

    public $Code;
    
    function __construct() {
        if (isset($_GET['lang'])) {
            $this->Code = $_GET['lang'];
        } else {
            $languages = explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach ($languages as $lang) {
                switch (substr($lang,0,2)) {
                    case "de":
                        $this->Code = "de";
                        break;
                    case "en":
                        $this->Code = "en";
                        break;
                }
            }
            //Default
            $this->Code = "en";
        }
            
    }
    
}

?>