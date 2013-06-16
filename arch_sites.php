<?php
require 'functions.php';
header('Content-Type: application/json');
$xml = simplexml_load_file('http://85.18.173.117/opendata/PuntiDiInteresseArcheologico.xml');
$temp = (object) array(
		'Archeological_points_of_interest' => array(
			)
	);

foreach( $xml->children() as $child)
{
	$number = (string) $child->numero;
        $ID = (string) $child->ID;
	$comune = (string) $child->comune;
	$localita = (string) $child->localita;
	$oggetto = (string) $child->oggetto;
	$IGMfoglio= (string) $child->IGMfoglio;
        $IGMquadrante= (string) $child->IGMquadrante;
        $IGMtavola= (string) $child->IGMtavola;
        $IGMtitolo= (string) $child->IGMtitolo;
        $CTRfoglio= (string) $child->CTRfoglio;
        $CTRsezione= (string) $child->CTRsezione;
        $CTRtitolo= (string) $child->CTRtitolo;
        $DataCompilazione= (string) $child->DataCompilazione;
        $bibliografia= (string) $child->bibliografia;

	$poi = (object) array(
		'PoI' => (object) array(
			'Number' => $number, 
			'ID' => $ID, 
			'Location' => $localita, 
			'Subject' => $oggetto,
                        'IGMquadrante'=> $IGMquadrante,
                        'IGMtavola'=> $IGMtavola,
                        'IGMtitolo'=> $IGMtitolo,
                        'CTRfoglio'=> $CTRfoglio,
                        'CTRsezione'=> $CTRsezione,
                        'CTRtitolo'=> $CTRtitolo,
                        'CompilationDate'=> $DataCompilazione,
                        'Bibliography'=> $bibliografia,

			)
		);
	$temp->Archeological_points_of_interest[] = $poi;
}
//echo "test";
echo indent(json_encode($temp));
$fp = fopen('archeological_sites.json', 'w');
fwrite($fp, indent(json_encode($temp)));
fclose($fp);
?>