<?php 

// function that does the conversion and returns true if no exception was thrown
function convert($xml,$tcx) {
    try {
        // Check file size
        if (empty($_FILES) || !file_exists($_FILES["kettlerFile"]["tmp_name"])) {
            throw new Exception('Es wurde keine Datei ausgew&auml;hlt.');
        } elseif ($_FILES["kettlerFile"]["size"] > 500000) {
            throw new Exception('Sorry, deine Datei ist zu gross.');
        } else {
        
            // Move the uploaded File into the xml-Folder and rename it
            move_uploaded_file($_FILES["kettlerFile"]["tmp_name"], $xml);

            // Build a training object and get the XML Code
            $training = new Kettler($xml);
        
            // Write tcx to file
            $myfile = fopen($tcx, "w");
            fwrite($myfile, $training->getTCX());
            fclose($myfile);
        } 
    } catch (Exception $e) {
        echo "<div id='error-div'>\n";
        echo "Es gab ein Problem mit deiner Datei:<br />\n<br />\n<i>";
        echo $e->getMessage() . "<br />\n";
        echo  "</i><br />\n";
        echo "Schicke mir bitte deine Trainingsdatei per Email, damit ich den Fehler beheben kann.<br />\n";
        echo "Kontakt: <a href='mailto:philipp@kettler2strava.com'>philipp@kettler2strava.com</a>";
        echo "</div>\n";
        
        // return false if there was an exception
        return false;
    }
    
    // return true if there was no exception
    return true;
}

function getLanguageCode() {
    if (isset($_GET['lang'])) {
        return $_GET['lang'];
    } else {
	    $languages = explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	    foreach ($languages as $lang) {
		    $languageCode = substr($lang,0,2);
		    switch ($languageCode) {
			    case "de":
				    return "de";
			    case "en":
				    return "en";
		    }
	    }
	}
	
	//Default
	return "en";
}

?>