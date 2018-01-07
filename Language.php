<?php

class Language {

    private $Code;
    private $Texts;
        
    function __construct() {
    
        //Determine the language code
        if (isset($_GET['lang'])) {  // If a paramter is set, use the language code provided there
            $this->Code = $_GET['lang'];
        } else { // use the browsers language code
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
            //Default is english
            if (!isset($this->Code)) {
                $this->Code = "en";
            }
        }
            
        // Load corresponding language file into array
        $this->Texts = parse_ini_file("./languages/$this->Code.ini");  
    }
    
    function get($key) {
        return $this->Texts[$key];
    }
    
}

?>