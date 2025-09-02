$(document).ready(function(){
    $("form").submit(function(){
        var number=$("#number").val();
        var supplier=$("#supplier").val();
        var date=$("#date").val();
        var material=$("#material").val();
        var price=$("#price").val();
        var qty=$("#qty").val();

        if(number==""){
            $("#msg").html("Order Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(supplier==""){
            $("#msg").html("Supplier Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(date==""){
            $("#msg").html("Order Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(material==""){
            $("#msg").html("Material Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(price=="" || parseFloat(price)<=0){
            $("#msg").html("Price must be a valid positive number!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(qty=="" || parseFloat(qty)<=0){
            $("#msg").html("Qty must be a valid positive number!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        var patNumber=/^[O][0-9]{5}$/;

        if(!number.match(patNumber)){
            $("#msg").html("Order Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 
                    
    })
})