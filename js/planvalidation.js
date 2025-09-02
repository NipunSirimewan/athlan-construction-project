$(document).ready(function(){
    $("form").submit(function(){
        var pnumber=$("#pnumber").val();
        var plan=$("#plan").val();

        if(pnumber==""){
            $("#msg").html("Project Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(plan==""){
            $("#msg").html("Project Plan Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        var patNumber=/^[P][0-9]{5}$/;

        if(!pnumber.match(patNumber)){
            $("#msg").html("Project Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 
                    
    })
})