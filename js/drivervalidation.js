$(document).ready(function(){
    $("form").submit(function(){
        var vtype=$("#vtype").val();
        var vnumber=$("#vnumber").val();
        var driver=$("#driver").val();
        var cnumber=$("#cnumber").val();
       

        if(vtype==""){
            $("#msg").html("Vehicle Type Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(vnumber==""){
            $("#msg").html("Vehicle Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(driver==""){
            $("#msg").html("Driver Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cnumber==""){
            $("#msg").html("Contact Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        var patMobile=/^[0][0-9]{9}$/;
        var patNumber=/^[A-Z]{2,3}[0-9]{4}$/;

        if(!cnumber.match(patMobile)){
            $("#msg").html("Contact Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 

        

        if(!vnumber.match(patNumber)){
            $("#msg").html("Vehicle Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 

       
    })
})