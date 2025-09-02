<?php

include_once '../model/project_model.php';
$projectObj=new Project();
$projectResult=$projectObj->getAllProjects();



//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Project Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Project Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The projects as of $date are as below",0,1,"L");

//header
$fpdf->Cell(25,10, "Number",1,0,"C");
$fpdf->Cell(50,10, "Project",1,0,"C");
$fpdf->Cell(45,10, "Start Date",1,0,"C");
$fpdf->Cell(45,10, "End Date",1,0,"C");
$fpdf->Cell(30,10, "Status",1,1,"C");

//data
while($projectrow=$projectResult->fetch_assoc()){

$fpdf->Cell(25,10, $projectrow['project_number'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(50,10, $projectrow['project_name'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $projectrow['start_date'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $projectrow['end_date'],1,0,"C");
$fpdf->SetFontSize("12");
$status=($projectrow["status"]=="1")?"Ongoing":"Complete";
$fpdf->Cell(30,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");


$fpdf->Output();