<?php

include_once '../model/supplier_model.php';
$supplierObj=new Supplier();
$supplierResult=$supplierObj->getAllSuppliers();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Supplier Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Supplier Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The suppliers as of $date are as below",0,1,"L");

//header
$fpdf->Cell(45,10, "Name",1,0,"C");
$fpdf->Cell(45,10, "Company",1,0,"C");
$fpdf->Cell(70,10, "Email",1,0,"C");
$fpdf->Cell(35,10, "Mobile",1,1,"C");

//data
while($supplierrow=$supplierResult->fetch_assoc()){

$fpdf->Cell(45,10, $supplierrow['supplier_name'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $supplierrow['company_name'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(70,10, $supplierrow['email'],1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(35,10, $supplierrow['contact_number'],1,1,"C");
$fpdf->SetFontSize("12");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");


$fpdf->Output();