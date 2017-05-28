
function crearCatCuentaDePag(){
			
	$(document).ready(function(){
		//a pulsar sobre el boton btn-send se creara una nueva categoria de forma asincrona
			
			//console.log("di clin");
			var datos=$('#formulario').serialize();

			//console.log($('#formulario').serialize()) //toma todos los datos del fomulario ;

			//ajax para insertar datos a la tabla categoria
			$.ajax({
            data:  datos,
            url:   'ajaxNewCategoria',
            type:  'post',
            beforeSend: function () {
                   // $("#resultado").html("Procesando, espere por favor...");
                   console.log("enviado espera...");

            },
            success:  function (data) {
            		//data-- es la respuesta del servidor
            		if(typeof(data.ms)!='undefined'){

            			var item, item2, nombre;
            			//setoma el nombre de la categoria
            			nombre=data.nombre;

            			alert(data.ms);

            			//se resetea el formulario para comodidad
            			$('#formulario')[0].reset();


            			//se crea el item para las categorias de la ventana modal con jquery
            			item=$('<span>',{
            				class:'label label-default',
            				text:nombre
            			}).append($('<a>',{
            				href:'javascript:void(0)',
            				text:' x',
            				id:data.last_id
            			}));


            			// se berifican que ayan 5 categorias para mostrar
            			//if($('ul.resientes.categorias ul'))


            			//se crea el item para las categorias de la ventana modal con jquery
            			item2=$('<li>',{}).append($('<a>',{
            				title:'titulo',
            				href:'url',
            			
            			}).append($('<span>',{

            				class:'fa fa-caret-right'

            			}),nombre));



            			//se agrega el item a el html
            			$('#etiqtas_catg').append(item);
            			$('ul.resientes.categorias').append(item2);


            		}

            	}
    		});

	});// /document.ready

} // /funcion


function eliminar_cuenta_de_pagina(url){

      if( confirm('Desea realmente eliminar este registro?')){
            window.location=url;
      }
}
