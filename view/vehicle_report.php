<?php

include_once '../model/vehicle_model.php';
$vehicleObj=new Vehicle();
$vehicleResult=$vehicleObj->getAllVehicles();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Vehicle Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Vehicle Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The vehicles as of $date are as below",0,1,"L");

//header
$fpdf->Cell(60,10, "Type",1,0,"C");
$fpdf->Cell(60,10, "Number",1,0,"C");
$fpdf->Cell(60,10, "Monthly Maintain",1,1,"C");

//data
while($vehiclerow=$vehicleResult->fetch_assoc()){

$status=($vehiclerow["status"]=="1")?"Done":"Not-Done";
$fpdf->Cell(60,10, $vehiclerow['vehicle_type'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(60,10, $vehiclerow['vehicle_number'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(60,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

















$fpdf->Output();