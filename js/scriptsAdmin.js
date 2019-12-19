$('#adminCat').click(function(){
    $.ajax({
        url: "../model/getCategories.php",
        type: "post",
        success: function(result){
            var resultObj = JSON.parse(result);

            if(resultObj.status=='OK'){
                let html='<input type="submit" id="newCat" value="nova categoria">'+
                '<input type="text" id="nuevaCat" placeholder="categoria" required>'+
                '<div id="categories"';
                for(let i=0; i<resultObj.datos.length; i++){
                    let categoria=resultObj.datos[i];
                    html+='<label><input class="categoria" type="checkbox" name="categorias" value="'+categoria['id']+'">'+categoria['nom']+'</label><br>';
                }
                html+='<input type="submit" id="eliminarCat" value="Eliminar Categorias">';
                var contenidoDiv = $('#contenido');
                contenidoDiv.html(html);
            }
        }
    });
});
$('#contenido').on('click', '#newCat', function(){
    let categ= $('#nuevaCat').val();

    if(categ.length > 30 || categ.length==0){
        alert("Error, categoria no valida");
    }else{
        novaCat(categ);
        alert("S'ha creat una nova categoria");
        location.reload();
    }
});

$('#contenido').on('click', '#eliminarCat', function(){
    let categ = [];
    	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".categoria:checked").each(function() {
		categ.push($(this).val());
	});
	
	/* we join the array separated by the comma */
    for (let i=0; i < categ.length; i++) {
        eliminarCat(categ[i]);
     }
     alert("S'han eliminat"+ categ.length+ "elements");
     location.reload();
});

function novaCat(categoria){
    $.ajax({
        url: "../model/novaCat.php",
        type: "post",
        data: {
            categoria : categoria
        },
    });
};

function eliminarCat(categoria){
    $.ajax({
        url: "../model/eliminarCat.php",
        type: "post",
        data: {
            categoria : categoria
        },
    });
};