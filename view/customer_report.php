<?php

include_once '../model/customer_model.php';
$customerObj=new Customer();
$customerResult=$customerObj->getAllCustomers();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Customer Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Customer Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The customers as of $date are as below",0,1,"L");

//header
$fpdf->Cell(60,10, "Name",1,0,"C");
$fpdf->Cell(60,10, "Email",1,0,"C");
$fpdf->Cell(60,10, "Mobile",1,1,"C");

//data
while($customerrow=$customerResult->fetch_assoc()){

$fpdf->Cell(60,10, $customerrow['first_name']." ". $customerrow['last_name'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(60,10, $customerrow['email'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(60,10, $customerrow['contact_number'],1,1,"C");
$fpdf->SetFontSize("12");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

















$fpdf->Output();