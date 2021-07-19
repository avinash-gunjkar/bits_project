<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('DOMPDF_ENABLE_AUTOLOAD', false);
//require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
require_once dirname(__FILE__) . '/domhtmltopdf/dompdf/autoload.inc.php';
//require_once("./vendor/dompdf/dompdf/autoload.inc.php");


use Dompdf\Dompdf;
//use Dompdf\Options;
class Pdf {

   public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
//       $options = new Options();
//       $options->set('isRemoteEnabled', TRUE);
//    $dompdf = new Dompdf($options);
    $dompdf = new DOMPDF();
    $dompdf->set_option('enable_html5_parser', TRUE);
    $dompdf->set_option('isRemoteEnabled', TRUE);
    $dompdf->set_option("isPhpEnabled", true);
    $dompdf->loadHtml($html);
  
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    $canvas = $dompdf->get_canvas();
    $canvas->page_text(512, 820, "Page: {PAGE_NUM} of {PAGE_COUNT}",$font, 8, array(0,0,0)); 

    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}