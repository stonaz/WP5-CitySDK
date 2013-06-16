<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/mappe/Musei.xml');
$temp = (object) array(
		'Museums' => array(
			)
	);

foreach( $xml->children() as $child)
{
	$city = (string) $child->Comune;
        $category = (string) $child->Categoria;
	$denomination = (string) $child->Denominazione;
	$address = (string) $child->Indirizzo;
	$phone = (string) $child->Telefono;
	$fax= (string) $child->Fax;
        $website= (string) $child->SitoWeb;
        $email= (string) $child->Email;
        $moreinfo= (string) $child->UlterioriInformazioni;
        

	$poi = (object) array(
		'Museum' => (object) array(
			'City' => $city, 
			'Category' => $category, 
			'Denomination' => $denomination,
                        'Address' => $address,
			'Phone' => $phone,
                        'Fax'  => $fax,
                        'Website'=> $website,
                        'Email'=> $email,
                        'More informations'=> $moreinfo,

			)
		);
	$temp->Museums[] = $poi;
}
//echo "test";
echo indent(json_encode($temp));
$fp = fopen('museums.json', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>