$(document).ready(function(){
    $(document).on('keyup', '#old_password', function(){
         var old_password = $("#old_password").val();
        $.ajax({
            type: 'post',
            url: '/admin/update-password',
            data:{old_password:old_password,},
            success:function(resp){
               if(resp == "false"){
                   $("#chkoldpwd").html("<font  > Current Password is InCorrect </font>").css({"color": "red"});
               }else if(resp =="true"){
                    $("#chkoldpwd").html("<font  > Current Password is Correct</font>").css({"color": "green"});
               }
            },error:function(){
                alert("eroor");
            }
        });


    });



    // $("#exampleCheck1").click(function(){
    //     if($(this).is(":checked")){
    //         $('input[type=checkbox]').prop('checked',true);        
    //     }else{
    //         $('input[type=checkbox]').prop('checked',false);  
    //     }
    // });

    // function checkPermissionByGroup(className, checkThis){
    //     const groupIdName = $("#"+checkThis.id);
    //     const classCheckBox = $('.'+className+' input');
    //     if(groupIdName.is(':checked')){
    //          classCheckBox.prop('checked', true);
    //      }else{
    //          classCheckBox.prop('checked', false);
    //      }
    //  }
});




