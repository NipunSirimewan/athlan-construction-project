$(document).ready(function(){
    $("form").submit(function(){
        var pro_number=$("#pro_number").val();
        var amount=$("#amount").val();
        var paid=$("#paid").val();
        var date=$("#date").val();
       

        if(pro_number==""){
            $("#msg").html("Project Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(amount=="" || parseFloat(amount)<=0){
            $("#msg").html("Project Amount must be a valid positive number!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(paid=="" || parseFloat(paid)<0){
            $("#msg").html("Amount Paid cannot be negative number!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(date==""){
            $("#msg").html("Paid Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

       
    })
})