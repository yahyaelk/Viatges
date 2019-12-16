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
    $('#headerRight').html('<button type="button" id="iniciarSessio" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Inicia Sessió</button>'+
    '<button type="button" id= "registrar" class="btn btn-secondary">Registrarse</button>');

}

function printLogged() {
    $('#myModal').modal('hide');

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
                        '<img class="card-img-top" src="img/card.jpg" alt="Card image cap">'+
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
    $.ajax({
        url: "model/getCategories.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);
            
            if(resultObj.status == 'OK'){
                var html = '<form class="form-signin">'+
                '<label for="inputTitol" class="sr-only">Títol</label>'+
                '<input type="text" id="inputTitol" class="form-control" placeholder="Titol" required autofocus>'+
                '<label for="inputData" class="sr-only">Data</label>'+
                '<input type="text" id="inputData" class="form-control" placeholder="Data" required>'+
                '<label for="inputText" class="sr-only">Text</label>'+
                '<input type="text" id="inputText" class="form-control" placeholder="Text" required>'+
                '<select id="inputCat" class="form-control">';

                for(var i = 0;i < resultObj.datos.length; i++){
                    var categoria = resultObj.datos[i];

                    html +='<option value="'+categoria['id']+'">'+categoria['nom']+'</option>';
                }

                html+='</select>'+
                    '<input type="button" id= "afegirExp" value= "Afegir">'+
                    '</form>';
                    $('#formulariExp').html(html);
            }

        }
    });
}));

$('#formulariExp').on('click', '#afegirExp', (function() {
    console.log ("entra");
    var titol = $('#inputTitol').val();
    var fecha = $('#inputData').val();
    var text = $('#inputText').val();
    var categoria = $('#inputCat').val();

    $.ajax({
        url: "model/afegir.php",
        type: "post",
        data: {
            titol: titol,
            fecha: fecha,
            text: text,
            categoria:categoria
        },
        success: function(result){
            var resultat = JSON.parse(result);
            if (resultat.status == 'OK'){
                console.log ("s'ha afegit");
            }
        }
    });
}));

    
