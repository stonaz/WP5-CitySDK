<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/mappe/AccessPoint.xml');
$temp = (object) array(
		'AccessPoints' => array(
			)
	);

foreach( $xml->children() as $child)
{
	$label_value = (string) $child->Denominazione;
	$latitude = (string) $child->Latitudine;
	$longitude = (string) $child->longitudine;
	$street_address = (string) $child->Indirizzo;
	$city = (string) $child->Comune;
        

	$poi = (object) array(
		'AccessPoint' => (object) array(
			'City' => $city, 
			'Denomination' => $label_value,
                        'Address' => $street_address,
			'latitude' => $latitude,
                        'longitude'  => $longitude

			)
		);
	$temp->AccessPoints[] = $poi;
}
echo indent(json_encode($temp));
//Writes to file
$fp = fopen('json/hotspots.json', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>