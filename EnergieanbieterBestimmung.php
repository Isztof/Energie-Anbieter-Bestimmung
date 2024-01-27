<?php
require_once ("./includes/startTemplate.inc.php");
require_once './klassen/DbFunctions.inc.php';
require_once './klassen/Energiedaten.inc.php';
require_once './klassen/Sicherheit.inc.php';
require_once './klassen/ErmittlungEnergieanbieter.inc.php';
require_once("./klassen/TCPDF/tcpdf.php");
require_once("./klassen/SVGGraph/autoloader.php");
session_start(); 
//Konstanten
define("MIN_PRAEMIE", 0);

$PHP_SELF = $_SERVER['PHP_SELF'];
$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
DEFINE("PATH_AND_FILENAME", "images/graph.svg");
DEFINE("ENCODING", "UTF-8");

//Verbindung zur Datenbank
$link = DbFunctions::connectWithDatabase();
$energiedaten = Energiedaten::holeDaten($link);

//Übergebe daten an die Benutzeroberfläche
$ueberschrift="Bestimmung Energieanbieter";
$smarty->assign('ueberschrift', htmlentities($ueberschrift));
$smarty->assign ( 'energiedaten', $energiedaten);

//csrf Prüfung
if (! ($REQUEST_METHOD == "POST"))
{
    if(!isset($_SESSION["csrfToken"]))
    {
        $_SESSION["csrfToken"] = bin2hex(random_bytes(64));
    }
    $smarty->assign ( 'csrfToken', $_SESSION["csrfToken"]);
    $smarty->assign ( 'PHP_SELF', $PHP_SELF );
    
} else {
    if(!isset($_POST["csrfToken"])||!isset($_SESSION["csrfToken"])||$_POST["csrfToken"] != $_SESSION["csrfToken"])
    {
        unset($_SESSION["csrfToken"]);
        die("CSRF Token ungültig!");
    }
 
    //Abfrage der daten
    $monatNr = $_POST['monat'];
    $sondertarif = $_POST['sondertarif'];
    $basisPraemie = $_POST['praemie'];
    $pdf = isset ( $_POST ['pdf'] );
    
    //Severseituige validierung der daten
    $correct = Sicherheit::isCorrectNumericalString($monatNr); 
    if($basisPraemie != '') {
        $correct = $correct && Sicherheit::isGreaterThanMin($basisPraemie, MIN_PRAEMIE);
    }
    if($sondertarif != '') {
        $correct = $correct && Sicherheit::isCorrectSondertarif($sondertarif);
    }
    
    if (! $correct) {
        $smarty->assign('fehler', true);
    } else {
        //Ergebnisbestimmung
        $gesamtenergiebedarf = Energiedaten::bestimmeGesamtenergiebedarf($link, $monatNr); 
        $energieanbieter = ErmittlungEnergieanbieter::bestimmeAnbieter($gesamtenergiebedarf);
        $energieverbrauchHash = Energiedaten::holeEnergieverbrauchHash($link, $monatNr);
        var_dump($energieverbrauchHash);
      
          $ausgabeText = "Der Gesamtenergiebedarf für den Monat: " . $energiedaten[$monatNr] . " betrug im vorherigen Zeitraum " . $gesamtenergiebedarf . " kWh.";
          
          
          $ausgabeText2 = "Der " . $energieanbieter . " wurde ausgwählt.";
         
            if (isset($basisPraemie)) {
                $ausgabeText3 = "Bitte eine Prämie in Höhe von " . $basisPraemie. " berücksichtigen.";
            } else {
                $ausgabeText3 = "";
            }
         
            //Einbidung des Diagramms     
            $settings = array(
                #'auto_fit' => true,
                #'back_colour' => '#eee',
                #'back_stroke_width' => 0,
                #'back_stroke_colour' => '#eee',
                #'stroke_colour' => '#000',
                #'axis_colour' => '#333',
                ##'axis_overlap' => 2,
                #'grid_colour' => '#666',
                #'label_colour' => '#000',
                #'axis_font' => 'Arial',
                #'axis_font_size' => 10,
                #'pad_right' => 20,
                #'pad_left' => 20,
                #'link_base' => '/',
                #'link_target' => '_top',
                #'project_angle' => 45,
                #'minimum_grid_spacing' => 20,
                #'show_subdivisions' => true,
                #'show_grid_subdivisions' => true,
                #'grid_subdivision_colour' => '#ccc',
            );
            $width = 700;
            $height = 300;
            $type = 'BarGraph';
            $colours = [ ['white', 'yellow'], ['white', 'red'] ];	
            
            $graph = new Goat1000\SVGGraph\SVGGraph($width, $height, $settings);
            $graph->colours($colours);
            $graph->values($energieverbrauchHash);
            $output=$graph->fetch($type);
            file_put_contents(PATH_AND_FILENAME, $output);
            
            //PDF ausgabe
            if ($pdf)
            {
                $xTextStart=10;
                $pdf=new TCPDF();
                $pdf->AddPage();
                $pdf->SetFont('Helvetica', "b", 14);
                $pdf->SetXY($xTextStart, 30);
                $pdf->Cell(16, 3, mb_convert_encoding($ueberschrift, ENCODING));
                $pdf->ImageSVG(PATH_AND_FILENAME,$xTextStart,40, 175);
                $pdf->SetFont('Helvetica', "", 10);
                $pdf->SetXY($xTextStart, 120);
                $pdf->Cell(16, 3, mb_convert_encoding($ausgabeText, ENCODING));
                $pdf->SetFont('Helvetica', "", 10);
                $pdf->SetXY($xTextStart, 130);
                $pdf->Cell(16, 3, mb_convert_encoding($ausgabeText2, ENCODING));
                if(isset($ausgabeText3))
                {
                    $pdf->SetFont('Helvetica', "i", 10);
                    $pdf->SetXY($xTextStart, 125);
                    $pdf->Cell(16, 3, mb_convert_encoding($ausgabeText3, ENCODING));
                }
                $pdf->Output();
                exit();
            }
            
            //Übermittlung der Ergebnisse an die Benutzeroberfläche
            $smarty->assign ( 'PATH_AND_FILENAME', htmlentities(PATH_AND_FILENAME));
            
            $smarty->assign('ausgabeText', htmlentities($ausgabeText));
            $smarty->assign('ausgabeText2', htmlentities($ausgabeText2));
            $smarty->assign('ausgabeText3', htmlentities($ausgabeText3));
            
    }
}

$smarty->display ( 'loesung.tpl' );