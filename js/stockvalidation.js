$(document).ready(function(){
    $("form").submit(function(){
        var type=$("#type").val();
        var available=$("#available").val();
        var reorder=$("#reorder").val();

        if(type==""){
            $("#msg").html("Material Type Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(available=="" || parseFloat(available)<0){
            $("#msg").html("Available QTY must be a valid positive number!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if(reorder=="" || parseFloat(reorder)<0){
            $("#msg").html("Reorder Level must be a valid positive number!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        

      
                    
    })
})