$(document).ready(function(){
    $("form").submit(function(){
        var sname=$("#sname").val();
        var cname=$("#cname").val();
        var email=$("#email").val();
        var cnumber=$("#cnumber").val();

        if(sname==""){
            $("#msg").html("Supplier Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cname==""){
            $("#msg").html("Company Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(email==""){
            $("#msg").html("Supplier Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        if(cnumber==""){
            $("#msg").html("Contact Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        

        
        var patMobile=/^[0][0-9]{9}$/;

        if(!cnumber.match(patMobile)){
            $("#msg").html("Contact Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
    })
})