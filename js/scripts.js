$('#iniciarSessio').click(function(){
    
$('#myModal').modal('show');
});


$(document).ready(function(){
    $("botoIni").click(function(){
        var username = $('#inputUser').val();
        var password = $('#inputPassword').val();

        $.ajax({
            url: "controller/checkUser.php",
            type: "post",
            data: {
                username: username,
                password: password
            },
            success: function(result){
                var msg= "";
                if (response== 1){
                    window.location= "iniciar.php";
                }
                else{
                    msg= "Invalid username and password";
                }
                $("#message").html(msg);
            }
        });
    });
  });