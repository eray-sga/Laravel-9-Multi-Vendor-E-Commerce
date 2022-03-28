$(document).ready(function(){
    //Check admin password is correct or not
    //klavyeden girilen parolayı anlık olarak dbde sorgulayıp mesaj verir.
    $("#current_password").keyup(function(){
        const current_password = $("#current_password").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/admin/check-admin-password',
            data: {current_password:current_password},
            success: function(resp){
                if(resp=="false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                } else if(resp=="true"){
                    $("#check_password").html("<font color='green'>Current Password is correct!</font>");
                }
            },error: function(){
                alert('error');
            }
        });
    });
});