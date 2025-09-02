<?php

include_once '../model/stock_model.php';
$stockObj=new Stock();
$stockResult=$stockObj->getAllStocks();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Stock Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Stock Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The stocks as of $date are as below",0,1,"L");

//header
$fpdf->Cell(60,10, "Material Type",1,0,"C");
$fpdf->Cell(60,10, "Available QTY",1,0,"C");
$fpdf->Cell(60,10, "Reorder Level",1,1,"C");

//data
while($stockrow=$stockResult->fetch_assoc()){

$fpdf->Cell(60,10, $stockrow['material_type'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(60,10, $stockrow['available_qty'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(60,10, $stockrow['reorder_level'] ,1,1,"C");
$fpdf->SetFontSize("12");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");


$fpdf->Output();