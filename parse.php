<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/mappe/AccessPoint.xml');
$temp = (object) array(
		'poi' => array(
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
		'poi' => (object) array(
			'lang' => 'it_IT', 
			'label' => (object) array(
				'lang' => 'it_IT', 
				'term' => 'primary', 
				'value' => $label_value
				), 
			'location' => (object) array(
				'point' => array(
					(object) array(
						'term' => 'entrance', 
						'Point' => (object) array(
							'srsName' => 'http://www.opengis.net/def/crs/EPSG/0/4326', 
							'posList' => $latitude.' '.$longitude
							)
						)
					), 
				'address' => (object) array(
					'type' => 'text/vcard', 
					'value' => "BEGIN:VCARD\r\nKIND:location\r\nADR;GEO=\"geo:{$latitude},{$longitude}\":;;{$street_address};{$city};;;;\r\nEND:VCARD"
					)
				), 
			'category' => array(
				(object) array(
					'lang' => 'en_GB', 
					'term' => 'category', 
					'value' => 'Access Point'
					)
				)
			)
		);
	$temp->poi[] = $poi;
}
echo "test";
echo indent(json_encode($temp));
?>