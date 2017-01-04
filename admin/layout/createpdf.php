
<?php


include_once("connection.php");
 $sql = "SELECT * FROM item";
$resultset = mysql_query($sql);
require('fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','',12);	
	$pdf->Ln();

$pdf->Cell(40,12,'Item Name',1);
		$pdf->Cell(100,12,'Description',1);
		$pdf->Cell(30,12,'stock',1);

while($rows = mysql_fetch_array($resultset)) {
	$pdf->SetFont('Arial','',12);	
	$pdf->Ln();
	//foreach($rows as $column) {
		$pdf->Cell(40,12,$rows['itemName'],1);
		$pdf->Cell(100,12,$rows['description'],1);
		$pdf->Cell(30,12,$rows['stock'],1);
	//}
}
$pdf->Output();
?>