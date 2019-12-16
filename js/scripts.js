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

    $('#afegir').html('');
    $('#ordenacio').html('');

}

function printLogged() {
    $('#myModal').modal('hide');

    $('#headerRight').html('<button id="btnSortir" type="button" class="btn btn-secondary">Sortir</button>');
    $('#afegir').html('<button id="btnAfegir" type="button" class="btn btn-primary">Afegir experiència</button>');
    $('#ordenacio').html('<div class="col-6 padding-8-4">'+
                        '<select class="form-control" id="selectOrdTipo">'+
                            '<option value="data">Data</option>'+
                            '<option value="puntuacio">Puntuació</option>'+
                        '</select>'+
                    '</div>'+
                    '<div class="col-6 padding-4-8">'+
                        '<select class="form-control" id="selectAscDesc">'+
                            '<option value="desc">Descendent</option>'+
                            '<option value="asc">Ascendent</option>'+
                        '</select>'+
                    '</div>');

    $.ajax({
        url: "model/getExperiencies.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);

            printExperiencies(resultObj);
        }
    });
    //PARTE DE FILTRAR POR CATEGORIA
    $.ajax({
        url: "model/getCategories.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);

            if(resultObj.status == 'OK'){
                var html= '<select id="inputCat" class="form-control">'+
                '<option value="todas">Todas</option>';
                for(var i = 0;i < resultObj.datos.length; i++){
                    var categoria = resultObj.datos[i];
                    html +='<option value="'+categoria['id']+'">'+categoria['nom']+'</option>';
                }
                html+='</select>';
                $('#filtreCat').html(html);
            }
        }
    });
    
    //HASTA AQUI
}

function printExperiencies(experiencies){

    var experienciesDiv = $('#experiencies');
    experienciesDiv.html('');

    for(let i = 0; i< experiencies.length; i++){
        var experiencia = experiencies[i];
        
        var fecha = new Date(experiencia['fecha_publ']);

        experienciesDiv.html(experienciesDiv.html() + '<div class="col-4 margin-bottom-20">'+
            '<div class="card" style="width: 18rem;">'+
                '<img class="card-img-top" src="' +experiencia['imatge']+ '" alt="Card image cap">'+
                '<div class="card-body">'+
                    '<h5 class="card-title">'+experiencia['titol']+'</h5>'+
                    '<p class="card-text"><small class="text-muted">'+fecha.getDate()+'-'+(fecha.getMonth() + 1)+'-'+fecha.getFullYear()+'</small></p>'+
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
};


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

    $('#ordenacio').on('change', '#selectOrdTipo', (function() {
        var tipo = $(this).val();
        var orden = $('#selectAscDesc').val();
        var categoria= $('#inputCat').val();

        ajaxOrdenacio(tipo, orden, categoria);
        
    }));

    $('#ordenacio').on('change', '#selectAscDesc', (function() {
        var tipo = $('#selectOrdTipo').val();
        var orden = $(this).val();
        var categoria= $('#inputCat').val();

        ajaxOrdenacio(tipo, orden, categoria);

    }));

    $('#filtreCat').on('change', '#inputCat', (function() {
        var tipo = $('#selectOrdTipo').val();
        var orden = $('#selectAscDesc').val();
        var categoria= $(this).val();

        ajaxOrdenacio(tipo, orden, categoria);
    }));
});

function ajaxOrdenacio(dataPunt, ascDesc, categoria){
    $.ajax({
        url: "model/ordenarExperiencies.php",
        type: "post",
        data: {
            dataPunt : dataPunt,
            ascDesc : ascDesc,
            categoria : categoria
        },
        success: function(result){
            var resultObj = JSON.parse(result);
            
            printExperiencies(resultObj);

        }
    });
};

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

    
