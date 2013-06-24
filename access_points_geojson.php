<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/mappe/AccessPoint.xml');
$temp = (object) array(
                'Type'   => 'FeatureCollection',
		'features' => array(
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
		
                'Type' => 'feature',
                'geometry' => (object) array(
                                            'Type' => 'Point', 
                                            'Coordinates' => $latitude.' , '.$longitude
                                            ),
                'properties' =>      (object) array(
                                            'Denomination' => $label_value,
                                            'City' => $city,
                                            'Address' => $street_address, 
                                            
                                            )
						
					
			
			
		);
	$temp->features[] = $poi;
}
echo indent(json_encode($temp));
$fp = fopen('json/hotspots.geojson', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>