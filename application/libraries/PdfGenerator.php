<?php
 
class PdfGenerator
{
  public function generate($html,$filename, $stream=TRUE, $paper = 'F4', $orientation = "portrait")
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $pdf = $dompdf->output();
    $file_location = $_SERVER['DOCUMENT_ROOT']."/sioutra/uploads/".$filename.".pdf";
	file_put_contents($file_location,$pdf); 
  }
}

