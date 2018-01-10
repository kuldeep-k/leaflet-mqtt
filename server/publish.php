<?php
require("vendor/autoload.php");
use Bluerhinos\phpMQTT;
$server = "localhost";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "mqtt-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()

$coords = [
    [ 28.6442033, 77.1118256, 'Location 1' ],
    [ 28.5501396, 77.1882317, 'Location 2' ],
    [ 28.6359866, 77.2608032, 'Location 3' ],
    [ 28.6805603, 77.1991786, 'Location 4' ]
];
$mqtt = new phpMQTT($server, $port, $client_id);
if ($mqtt->connect(true, NULL, $username, $password)) {
    for($i=0;$i<count($coords);$i++) { 
    	$mqtt->publish("map/coordinates", json_encode($coords[$i]), 0);
        sleep(2);
    }
	$mqtt->close();
} else {
    echo "Time out!\n";
}
