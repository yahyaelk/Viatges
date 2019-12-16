$('#iniciarSessio').click(function(){
    $('#myModal').modal('show');
});

function printNoLogged() {
    $.ajax({
        url: "model/getExperiencies.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);

            var experienciesDiv = $('#experiencies');
            experienciesDiv.html('');

            for(let i = 0; i< resultObj.length; i++){
                var experiencia = resultObj[i];

                experienciesDiv.html(experienciesDiv.html() + '<div class="col-4 experiencia">' + experiencia['titol'] + '</div>');
            }

        }
    });

    $('#myModal').modal('hide');
    $('#myModalExp').modal('hide');
    $('#headerRight').html('<button type="button" id="iniciarSessio" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Inicia Sessió</button>'+
    '<button type="button" id= "registrar" class="btn btn-secondary">Registrarse</button>');

}

function printLogged() {
    $('#myModal').modal('hide');
    $('#myModalExp').modal('hide');

    $('#headerRight').html('<button id="btnSortir" type="button" class="btn btn-secondary">Sortir</button>');
    $('#afegir').html('<button id="btnAfegir" type="button" class="btn btn-primary">Afegir experiència</button>');

    $.ajax({
        url: "model/getExperiencies.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);

            var experienciesDiv = $('#experiencies');
            experienciesDiv.html('');

            for(let i = 0; i< resultObj.length; i++){
                var experiencia = resultObj[i];
                
                var fecha = new Date(experiencia['fecha_publ']);

                experienciesDiv.html(experienciesDiv.html() + '<div class="col-4 margin-bottom-20">'+
                    '<div class="card" style="width: 18rem;">'+
                        '<img class="card-img-top" src="' +experiencia['imatge']+ '" alt="Card image cap">'+
                        '<div class="card-body">'+
                            '<h5 class="card-title">'+experiencia['titol']+'</h5>'+
                            '<p class="card-text"><small class="text-muted">'+fecha.getUTCDay()+'-'+fecha.getUTCMonth()+'-'+fecha.getUTCFullYear()+'</small></p>'+
                            '<p class="card-text">'+experiencia['contingut']+'</p>'+
                        '</div>'+
                        '<div class="card-footer d-flex justify-content-between">'+
                            '<div class="col-6">'+
                                '<button class="like" id="like'+experiencia['id']+'"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>'+
                                '<div class="color-cyan" id="countLikes'+experiencia['id']+'">'+experiencia['valoracioPos']+'</div>'+
                            '</div>'+
                            '<div class="col-6">'+
                            '<button class="dislike" id="dislike'+experiencia['id']+'"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>'+
                            '<div class="color-red" id="countDislikes'+experiencia['id']+'">'+experiencia['valoracioNeg']+'</div>'+
                            '</div>'+
                        '</div>'+
                        '</div>'+
                    '</div>');
            }

        }
    });
}


$(document).ready(function(){
    $.ajax({
        url: "model/checkLogged.php",
        type: "post",
        success: function(result){

            if(result == 'true'){
                printLogged();
            }else{
                printNoLogged();
            }
            
        }
    });

    $('#botoIni').click(function() {
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
                    printLogged();
                }else{
                    msg= "Invalid username and password";
                }

                $("#message").html(msg);
            }
        });
    });

    $('#headerRight').on('click', '#btnSortir', function(){
        $.ajax({
            url: "model/sortir.php",
            type: "post",
            success: function(result){
                printNoLogged();
            }
        });
    });

    $('#experiencies').on('click', "[id^='like']", function(){
        var id = this.id.replace('like','');

        if(id != '' && !isNaN(id)){
            $(this).attr('disabled', true);

            $.ajax({
                url: "model/likeDislike.php",
                type: "post",
                data: {
                    accion: 'like',
                    id: id
                },
                success: function(result){
                    var resultObj = JSON.parse(result);
    
                    if(resultObj.status == 'OK'){
                        $('#countLikes'+id).html(resultObj.num);
                    }
    
                }
            });
        }
        
    });

    $('#experiencies').on('click', "[id^='dislike']", function(){
        var id = this.id.replace('dislike','');

        if(id != '' && !isNaN(id)){
            $(this).attr('disabled', true);

            $.ajax({
                url: "model/likeDislike.php",
                type: "post",
                data: {
                    accion: 'dislike',
                    id: id
                },
                success: function(result){
                    var resultObj = JSON.parse(result);
    
                    if(resultObj.status == 'OK'){
                        $('#countDislikes'+id).html(resultObj.num);
                    }
    
                }
            });
        }
        
    });
});

  

$('#afegir').on('click', '#btnAfegir', (function() {
    $('#myModalExp').modal('show');
}));

$('#myModalExp').on('click', '#afegirExp', (function() {
    var regData= /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;

    var titol = $('#inputTitol').val();
    var fecha = $('#inputData').val();
    var text = $('#inputText').val();

    var correcto = true;

    var titolRes= $('#titolRes');
    titolRes.html('');
    var fechaRes= $('#fechaRes');
    fechaRes.html('');
    var textRes= $('#textRes');
    textRes.html('');


    if(titol.length > 50 || titol.length==0){
        titolRes.html('Títol incorrecte');
        correcto = false;
    }
    if(!regData.test(fecha)){
        console.log("entra fecha");
        fechaRes.html('Data incorrecte');
        correcto = false;
    }

    if(text.length>400 || text.length==0){
        console.log("entra text");
        textRes.html('Text incorrecte');
        correcto = false;
    }

    if(correcto){
        $.ajax({
            url: "model/afegir.php",
            type: "post",
            data: {
                titol: titol,
                fecha: fecha,
                text: text
            },
            success: function(){
                $('#formulariExp').modal('hide');
            }
        });
    }
}));

    
