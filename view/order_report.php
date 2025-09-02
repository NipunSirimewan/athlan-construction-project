<?php

include_once '../model/order_model.php';
$orderObj=new Order();
$orderResult=$orderObj->getAllOrders();

//include the library
include '../commons/fpdf186/fpdf.php';
$fpdf=new FPDF ("P");

//document title
$fpdf->SetTitle ("Orders Reprot");

$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");

//logo
$fpdf->Image("../images/logo.jpg",10,15,30,20,);

//heading
$fpdf->Cell(0,30,"Order Report",0,1,"C");

//title
$fpdf->SetFontSize("12");
$fpdf->Cell(0,15,"The orders as of $date are as below",0,1,"L");

//header
$fpdf->Cell(45,10, "Order Number",1,0,"C");
$fpdf->Cell(45,10, "Order Date",1,0,"C");
$fpdf->Cell(45,10, "Total (Rs)",1,0,"C");
$fpdf->Cell(45,10, "Status",1,1,"C");

//data
while($ordersrow=$orderResult->fetch_assoc()){

$status=($ordersrow["status"]=="1")?"Success":"Pending";
$fpdf->Cell(45,10, $ordersrow['order_number'] ,1,0,"C");
$fpdf->SetFontSize("11");
$fpdf->Cell(45,10, $ordersrow['date'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, $ordersrow['total'] ,1,0,"C");
$fpdf->SetFontSize("12");
$fpdf->Cell(45,10, "$status",1,1,"C");

}

$fpdf->SetFontSize("10");
$fpdf->Cell(0,10, "This is a computer generated document and requires no authorized signature", 0,1,"L");

$fpdf->Output();