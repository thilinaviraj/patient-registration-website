<?php 
session_start();

require_once('tcpdf/tcpdf.php');


if (isset($_SESSION['print'])){
    $html = $_SESSION['print'];
    
}
else{
    echo "Broken";
    exit();
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Colombo Friend-in-need Society');
$pdf->SetTitle('Name Label List');
$pdf->SetSubject('Name Labels');


// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 12);

// add a page
$pdf->AddPage();

/*
// set some text to print
$html = '<table border="1" cellspacing="3" cellpadding="4">
                <thead>
                </thead>
                <tbody>
                
                <tr>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                </tr>
                <tr>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                </tr>
                <tr>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                </tr>
                <tr>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                <td>Keshan Rasnayake<br>26C, <br>De Melwatta Road, <br>Koswatta, <br>Nawala</td>
                </tr>
                
                </tbody>
            </table>';

*/

// print a block of text using Write()
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>