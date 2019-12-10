$('#iniciarSessio').click(function(){
    
$('#myModal').modal('show');
});


$(document).ready(function(){
    $("botoIni").click(function(){
        var username = $('#inputUser').val();
        var password = $('#inputPassword').val();

        $.ajax({
            url: "controller/iniciar.php",
            type: "post",
            data: {
                username: username,
                password: password
            },
            success: function(result){
                
            }
        });
    });
  });