<?php
require_once('./Device.php');

class KettlerFile {

    // Converter Class accepts a filename and returns a filename after converting. Internally it uses the Device Object
    private $kettler_dir = "./kettler-files/";
    private $tcx_dir = "./tcx-files/";
    private $name;
    private $kettler_filename;
    
    function __construct($uploaded_file) {
        // Check file size
        if (empty($uploaded_file) || !file_exists($uploaded_file["tmp_name"])) {
            throw new Exception('No File selected.',100);
        } elseif ($uploaded_file["size"] > 500000) {
            throw new Exception('Filesize too big.',200);
        } else {
            // Move the uploaded File into the xml-Folder and rename it
            $this->name = "training" . date("Y-m-d_H:i:s_") .  uniqid();
            $this->kettler_filename = $this->kettler_dir . $this->name . ".xml"; 
            move_uploaded_file($uploaded_file["tmp_name"], $this->kettler_filename);
        }
    }
     
    function getDevice() {
        // TODO ...
        return "Ergometer E5";
    }
    
    function convert() {

        $tcx_filename = $this->tcx_dir . $this->name . ".tcx";
        
        // Build a training object and get the XML Code
        $training = new Device($this->kettler_filename);
    
        // Write tcx to file
        $tcxfile = fopen($tcx_filename, "w");
        fwrite($tcxfile, $training->getTCX());
        fclose($tcxfile);
        
        return $tcx_filename;
   
    }

} 

?>