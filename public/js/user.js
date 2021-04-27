$(document).ready(function(){
    $(document).on('keyup', '#userold_password', function(){
         var userold_password = $("#userold_password").val();
        $.ajax({
            type: 'post',
            url: '/update-password',
            data:{userold_password:userold_password,},
            success:function(resp){
                if(resp == "false"){
                    $("#uschkoldpwd").html("<font  > Current Password is InCorrect </font>").css({"color": "red"});
                }else if(resp =="true"){
                     $("#uschkoldpwd").html("<font  > Current Password is Correct</font>").css({"color": "green"});
                }
            },error:function(){
                alert("eroor");
            }
        });


    });
});