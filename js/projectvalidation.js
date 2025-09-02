$(document).ready(function(){
    $("form").submit(function(){
        var pro_number=$("#pro_number").val();
        var pro_name=$("#pro_name").val();
        var cus_name=$("#cus_name").val();
        var pro_manager=$("#pro_manager").val();
        var pro_location=$("#pro_location").val();
        var city=$("#city").val();
        var amount=$("#amount").val();
        var start_date=$("#start_date").val();
        var end_date=$("#end_date").val();

        if(pro_number==""){
            $("#msg").html("Project Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if(pro_name==""){
            $("#msg").html("Project Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cus_name==""){
            $("#msg").html("Customer Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(pro_manager==""){
            $("#msg").html("Project Manager Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(pro_location==""){
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(city==""){
            $("#msg").html("City Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(amount=="" || parseFloat(amount)<=0){
            $("#msg").html("Amount must be a valid positive number!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if(start_date==""){
            $("#msg").html("Start Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if(end_date==""){
            $("#msg").html("End Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        var patNumber=/^[P][0-9]{5}$/;

        if(!pro_number.match(patNumber)){
            $("#msg").html("Project Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 
       
    })
})