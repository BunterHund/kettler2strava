<?php

class Device {

    // Class Variable for the original XML
	private $xml;
	
	const XMLHEADER = "<?xml version='1.0' standalone='yes'?>";
	
	// XML Tags for the tcx file
	const XMLHEADER_TCX = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	const RECORD_OPEN = "<Trackpoint>";
    const RECORD_CLOSE = "</Trackpoint>";
    const PULSE_OPEN = "<HeartRateBpm><Value>";
    const PULSE_CLOSE = "</Value></HeartRateBpm>";
    const CADENCE_OPEN = "<Cadence>";
    const CADENCE_CLOSE = "</Cadence>";
    const WATTS_OPEN = "<Extensions><TPX><Watts>";
    const WATTS_CLOSE = "</Watts></TPX></Extensions>";
    const TIME_OPEN = "<Time>";
    const TIME_CLOSE = "</Time>";
	
	function __construct($fileName) {
		
	    $kettlerString = file_get_contents($fileName);
		
		// Add header and wrap everything in an Activity-Tag
	    $kettlerString = self::XMLHEADER . "\n" . "<Activity>\n" . $kettlerString;
	    $kettlerString = $kettlerString . "\n</Activity>";
	    
	    // Get XML Structure
	    $this->xml = new SimpleXMLElement($kettlerString);
	
	}
	
    function getTCX() {
    
        // Get the start date as a DateTime object
        $timeString = $this->xml->Training->Time;
        $dateString = $this->xml->Training->Date;
        $date = DateTime::createFromFormat('d.m.Y-G:i:s',$dateString . "-" . $timeString);
        $startDate = $date->format('Y-m-d') . "T" . $date->format('G:i:s') . ".000Z";
        $intervall =  $this->xml->Training->RecordIntervall . "\n";
        
        // Beginning of the TCX
	    $xmlIntro = <<<EOT
<TrainingCenterDatabase>
  <Activities>
    <Activity Sport="Training">
      <Id>$startDate</Id>
      <Lap StartTime="$startDate">
        <Track>\n
EOT;
        $xmlFooter = "</Track></Lap></Activity></Activities></TrainingCenterDatabase>";
        
        $tcxString .= $this::XMLHEADER_TCX . "\n" .  $xmlIntro . "\n";

        foreach ($this->xml->Record as $record) {
            $tcxString .= $this::RECORD_OPEN . "\n";
            // include time
            $tcxString .= $this::TIME_OPEN;
            $tcxString .= $date->format('Y-m-d') . "T" . $date->format('G:i:s') . ".000Z";
            $tcxString .= $this::TIME_CLOSE . "\n";
            // count up time
            $date->add(new DateInterval('PT10S'));
 	        $tcxString .= $this::PULSE_OPEN . $record->Pulse . $this::PULSE_CLOSE . "\n";
 	        $tcxString .= $this::CADENCE_OPEN . $record->RPM . $this::CADENCE_CLOSE . "\n";
 	        $tcxString .= $this::WATTS_OPEN . $record->Power . $this::WATTS_CLOSE . "\n";
 	        $tcxString .= $this::RECORD_CLOSE . "\n";
        }

        $tcxString .= $xmlFooter;
        
        return $tcxString;
    }
	    
}

?>