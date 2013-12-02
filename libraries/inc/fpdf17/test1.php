<?php
require_once('fpdf.php');

$paperpdf = new paperpdf; 
$paperpdf->AddPage('P'); 
$paperpdf->SetMargins(0,0,0); 
$paperpdf->SetFont('Arial','','10'); 
$paperpdf->SetXY(50,20); 
$paperpdf->Write('','I am going to print',''); 

$paperpdf->IncludeJS("print('true');"); 

$paperpdf->Output('foobar.pdf','I');  
?>