<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/mappe/Biblioteche.xml');
$temp = (object) array(
		'Libraries' => array(
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
		'Library' => (object) array(
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
	$temp->Libraries[] = $poi;
}
//echo "test";
echo indent(json_encode($temp));
$fp = fopen('json/libraries.json', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>