<?php

include_once '../model/driver_model.php';
$driverObj=new Driver();
$driverResult=$driverObj->getAllDrivers();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Drivers Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Driver Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The drivers as of $date are as below",0,1,"L");

//header
$fpdf->Cell(45,10, "Driver",1,0,"C");
$fpdf->Cell(45,10, "Vehicle Type",1,0,"C");
$fpdf->Cell(45,10, "Vehicle Number",1,0,"C");
$fpdf->Cell(45,10, "Status",1,1,"C");

//data
while($driverrow=$driverResult->fetch_assoc()){

$status=($driverrow["status"]=="1")?"Available":"Not-Available";
$fpdf->Cell(45,10, $driverrow['driver'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(45,10, $driverrow['vehicle_type'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $driverrow['vehicle_number'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

$fpdf->Output();