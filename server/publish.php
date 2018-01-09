<?php
require("vendor/autoload.php");
use Bluerhinos\phpMQTT;
$server = "localhost";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "mqtt-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()

$coords = [
    [ 28.6673034, 77.3875586, 'Sector 2, Vasundhara, Ghaziabad, UP, India' ],
    [ 28.6636672, 77.3843036, 'Sector 3, Vasundhara, Ghaziabad, UP, India' ],
    [ 28.668002,  77.3797523, 'Sector 4, Vasundhara, Ghaziabad, UP, India' ],
    [ 28.6613294, 77.3745191, 'Sector 5, Vasundhara, Ghaziabad, UP, India' ]
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
