<?php

include_once '../model/material_model.php';
$materialObj=new Material();
$materialResult=$materialObj->getAllMaterials();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Material Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Material Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The materials as of $date are as below",0,1,"L");

//header
$fpdf->Cell(80,10, "Material Number",1,0,"C");
$fpdf->Cell(80,10, "Material Type",1,1,"C");

//data
while($materialrow=$materialResult->fetch_assoc()){

$fpdf->Cell(80,10, $materialrow['material_number'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(80,10, $materialrow['material_type'] ,1,1,"C");
$fpdf->SetFontSize("12");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

















$fpdf->Output();