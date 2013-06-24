<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/opendata/EventiRomaEPiu.xml');
$temp = (object) array(
		'Events' => array(
			)
	);

foreach( $xml->children() as $child)
{
	$day = (string) $child->GiornoDiRiferimento;
        $title = (string) $child->TitoloEvento;
        $from_day = (string) $child->DataInizioEvento;
        $to_day = (string) $child->DataFineEvento;
        $preview = (string) $child->AnteprimaInformazioni;
        $more_informations_link = (string) $child->LinkUlterioriInformazioni;
        $website = (string) $child->SitoInternetEvento;
	$latitude = (string) $child->Latitudine;
	$longitude = (string) $child->Longitudine;
	$street_address = (string) $child->Indirizzo;
	$phone_number = (string) $child->Telefono;

	$poi = (object) array(
		
                
                'Event' => (object) array(

                                            'Day' => $day,
                                            'Title' => $title,
                                            'From day' => $from_day,
                                            'To day' => $from_day,
                                            'Preview' => $preview,
                                            'More informations' => $more_informations_link,
                                            'Website' => $website,
                                            'Address' => $street_address,
                                            'Phone number' => $phone_number,
                                            
                                            )
						
					
			
			
		);
	$temp->Events[] = $poi;
}
echo indent(json_encode($temp));
$fp = fopen('json/events.json', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>