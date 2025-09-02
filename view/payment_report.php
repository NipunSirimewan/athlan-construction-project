<?php

include_once '../model/payment_model.php';
$paymentObj=new Payment();
$paymentResult=$paymentObj->getAllPayments();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Payments Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Project Payment Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The project payments as of $date are as below",0,1,"L");

//header
$fpdf->Cell(45,10, "Project Amount",1,0,"C");
$fpdf->Cell(45,10, "Amount Paid",1,0,"C");
$fpdf->Cell(45,10, "Paid Date",1,0,"C");
$fpdf->Cell(45,10, "Payment",1,1,"C");

//data
while($paymentrow=$paymentResult->fetch_assoc()){

$status=($paymentrow["status"]=="1")?"Done":"Not-Done";
$fpdf->Cell(45,10, $paymentrow['project_amount'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(45,10, $paymentrow['amount_paid'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $paymentrow['paid_date'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

$fpdf->Output();