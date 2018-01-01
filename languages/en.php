<?php

$lang = array(
    'claim' => 'Share your ergometer trainings on Strava!',
    'converter' => 'Converter',
    'devices' => 'Devices',
    'background' => 'Background',
    'contact' => 'Contact',
    'title' => 'Upload Ergometer Training Data to Strava',
    'keywords' => 'Kettler, Ergometer, XML, TCX, Strava, convert, export',
    'description' => 'Convert your training data from kettler into tcx files and upload it to Strava.',
    'heading' => 'kettler2strava',
    'download' => 'Your tcx file:',
    'formtext' => 'Upload your kettler training file: ',
    'convertbutton' => '  convert to tcx  ',
    'supporteddevices' => 'Supported Devices',
    'devicestext1' => 'I have a <em>Kettler ergometer E5</em>, to which I can connect a USB stick during the training. In the <em>ergo v2</em> folder, a file is saved on the stick for each training session. So far I could not test the converter with any training files from other devices. The list of supported devices is therefore rather short ... but that can change!',
    'devicestext2' => 'If your ergometer is not on this list, you can still try the converter. Contact me if the converter does not work so I can change it accordingly.',
    'backgroundtext1' => 'When I recorded the first training sessions with a USB stick using my <em> Kettler ergometer E5</em>, I soon realized that these files unfortunately can not be imported into Strava. Of course, I could easily record my workouts with my running watch, but then the cadence and power (in watts) the ergometer measures would be lost. In order to be able to use this data as well, I have written a small converter, which I put online here. The training files from the USB stick are converted into TCX files that can be uploaded to Strava.',
    'backgroundtext2' => 'If you have another ergometer that does not work for the conversion, feel free to send me a training file so I can customize the converter.',
    'backgroundtext3' => 'During exercise, my ergometer will also display <em>speed</em>, <em>calorie consumption</em>, and <em>distance traveled</em>. However, only <em>pulse</em,<em>cadence</em> and <em>power </em> are stored in the training file. It is this data, that is transferred to the .tcx file. Strava then calculates the calorie consumption from the power data by itself (see: <a href="https://support.strava.com/hc/en-us/articles/216917097-Calorie-Calculation"> Calorie Calculation </a>).'    
);

?>