$(document).ready(function(){
    $("form").submit(function(){
        var mnumber=$("#mnumber").val();
        var mtype=$("#mtype").val();

        if(mnumber==""){
            $("#msg").html("Material Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(mtype==""){
            $("#msg").html("Material Type Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        var patNumber=/^[M][0-9]{3}$/;

        if(!mnumber.match(patNumber)){
            $("#msg").html("Material Number is invalid!!");
            $("#msg").addClass("alert alert-danger");
            return false;
        } 
                    
    })
})