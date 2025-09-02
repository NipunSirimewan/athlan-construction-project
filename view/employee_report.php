<?php

include_once '../model/employee_model.php';
$employeeObj=new Employee();
$employeeResult=$employeeObj->getAllEmployees();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Employee Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Employee Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The employees as of $date are as below",0,1,"L");

//header
$fpdf->Cell(60,10, "Name",1,0,"C");
$fpdf->Cell(60,10, "Email",1,0,"C");
$fpdf->Cell(60,10, "Status",1,1,"C");

//data
while($employeerow=$employeeResult->fetch_assoc()){

$status=($employeerow["status"]=="1")?"Active":"Deactive";
$fpdf->Cell(60,10, $employeerow['first_name']." ". $employeerow['last_name'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(60,10, $employeerow['email'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(60,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

















$fpdf->Output();