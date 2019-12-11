$('#iniciarSessio').click(function(){
    
$('#myModal').modal('show');
});


$(document).ready(function(){
    $("#botoIni").click(function(){
        var username = $('#inputUser').val();
        var password = $('#inputPassword').val();

        $.ajax({
            url: "model/login.php",
            type: "post",
            data: {
                username: username,
                password: password
            },
            success: function(result){
                var resultObj = JSON.parse(result);
                var msg= "";

                if(resultObj.status == 'OK'){
                    //COMPLETAR
                }else{
                    msg= "Invalid username and password";
                }

                $("#message").html(msg);
            }
        });

    });
  });