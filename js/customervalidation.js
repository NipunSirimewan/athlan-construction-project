$(document).ready(function(){
    $("form").submit(function(){
        var fname=$("#fname").val();
        var lname=$("#lname").val();
        var email=$("#email").val();
        var nic=$("#nic").val();
        var cnumber=$("#cnumber").val();

        if(fname==""){
            $("#msg").html("First Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(lname==""){
            $("#msg").html("Last Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(email==""){
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(nic==""){
            $("#msg").html("NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cnumber==""){
            $("#msg").html("Contact Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        

        var patNic=/^([0-9]{9}[vVxX]|[0-9]{12})$/;
        var patMobile=/^[0][0-9]{9}$/;

        if(!nic.match(patNic)){
            $("#msg").html("NIC is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(!cnumber.match(patMobile)){
            $("#msg").html("Contact Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
    })
})