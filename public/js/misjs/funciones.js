
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



function eliminarRecordatorio(routeId){
	x=confirm('Esta seguro que desea eliminarlo?');

	if(x){
		window.location=routeId;

	}
}

function eliminarConfirm(routeId){
	x=confirm('Esta seguro que desea eliminarlo?');

	if(x){
		window.location=routeId;

	}
}

function enviarFormuarioConEnter(event,formulario=null){
	// PARA VER QUE TECLA ESTA PRESIONADO 

	//VALIDO LA TECLA PRESIONADA
	if(event.keyCode == 13){ //13 = ENTER
		//AQUI PUEDES PONER EL ENVIO DEL FORMULARIO : document.formulario.submit; 
		if(!formulario==null){
			//enviamos el fomrulario
			$(formulario).submit();
		}
	}

}

$(document).ready(function() {	


	$("a").parents('li').css("color", "red");
	
	function crearHtml(texto, ids){

		var jquery=$('<div>',{
						id:ids,
						class:'row codeitem margin-top-20px margin-bottom-50px'
					 }).append($('<div>',{
					 	class:'col-md-1'

					 }), $('<div>',{
					 	class:'col-md-10'

					 }).append($('<div>',{
					 	class:'row'
					 }).append($('<div>',{
					 	class:'col-md-12'

					 }).append($('<h2>',{
					 	class:'font-size-30 margin-bottom-10px',
					 	text:texto

					 }))), $('<textarea>',{
					 	class:'form-control  input-lg height-200',
					 	name:ids
					 }),$('<div>',{
					 	name:ids,
					 	class:'btn btn-info eliminar-textarea',
					 	text:'x'

					 }),$('<div>',{
					 	name:ids,
					 	class:'btn btn-info eliminar-textarea visible-xs',
					 	text:'x'

					 })), $('<div>',{
					 	class:'col-md-1'

					 })).appendTo('#codigo');
		
				 
	}	


	$("select[id=tipo]").change(function(){
				
			//alert($('#tipo option:selected').text());
			var v=0;
			v =$('#tipo option:selected').html();
			
			//Proyecto laravel
			$("div[id=modelo]").remove();
			$("div[id=vista]").remove();
			$("div[id=controller]").remove();

			//Proyecto html
			$("div[id=html]").remove();
	        $("div[id=css]").remove();
	        $("div[id=php]").remove();
	        $("div[id=javascript]").remove();
	        $("div[id=jquery]").remove();

	        //oracle
	        $("div[id=sql]").remove();
			$("div[id=plsql]").remove();


			switch (v) {

				
				//console.log('k'+$('select[id=tipo]').attr('value'));
			    case '':
			        alert("porfavor elija una opcion");
			        break;

			    case 'html':
			    	
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			         $(".codeitem").trigger('create');
			        break;


			    case 'laravel':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Modelo','modelo');
			        crearHtml('Vista','vista');
			        crearHtml('Controlador','controlador');
			         $(".codeitem").trigger('create');
			        break;

			    case 'Oracle':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/

			        crearHtml('Sql','sql');
			        crearHtml('Plsql','plsql');

			        $(".codeitem").trigger('create');
			        break;


			    case 'htmlycss':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			        crearHtml('Css','css');
			         $("#codigo").trigger('create');
			        break;

			    case 'apphtml':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			        crearHtml('Css','css');
			        crearHtml('Php','php');
			        crearHtml('Javascript','javascript');
			        crearHtml('Jquery','jquery');
			         $("#codigo").load();
			        break;

			    case 'javascript':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			        crearHtml('Javascript','javascript');
			         $("#codigo").trigger('create');
			        break;

			    case 'php':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			        crearHtml('Php','php');
			        $("#codigo").trigger('create');
			        break;

			    case 'jquery':
			        /*alert("Elejiste =>"+ $('select[id=tipo]').val() );*/
			        crearHtml('Html','html');
			        crearHtml('Css','css');
			        crearHtml('Jquery','jquery');
			        $("#codigo").trigger('create');
			        break;
			    
			}
            
            
        });

	

	

	/*aparece y desaparece boton */
	$('#codigo').delegate('.codeitem', 'mouseenter', function(){

		$(this).find('.eliminar-textarea').css('display','block');

		/*Eliminar elementos*/
		$(this).find('.eliminar-textarea').on('click',function(){
			var n = '#'+ $(this).attr('name');
			$(n).remove();
			console.log(n);
		})

		
	}).delegate('.codeitem', 'mouseleave', function(){


		$(this).find('.eliminar-textarea').css('display','none');

	});


	/*Eliminar elementos*/
	/*$('.eliminar-textarea').on('click',function(){

		var n ="#"+ $(this).attr('name');
		
		//$(n).remove();
		console.log(n);
	});*/


	/*Mover scroll hacia un elemento*/

	/*function moverscroll(elemento){

		var posicion = $(elemento).offset().top;
	    $("html, body").animate({
	        scrollTop: posicion
	    }, 2000); 

	}*/
	
	/*Funcion para mostrar peestaña automatica
	esto hace que si tenemos la paginacion para laravel nos mostrara la pestaña de laravel*/
	$(window).load(function(){
		var t=getParameterByName('page');
		var tt=getParameterByName('laraPage');
		

		if(t!=0){

			$('#myTabs a[href="#home"]').tab('show');
		}

		if(tt!=0){
			$('#myTabs a[href="#laravel"]').tab('show');
		}

	});


	var mecesi;//meces Ingles
	var mecese;//Meces Español
	var i=0;

	mecesi = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
	mecese = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septimber", "Octubre", "Noviember", "Dicimber" ];
	
	$("time[class='tiempo']").each(function(){
		
		for(i=0; i<mecesi.length; i++){

			if($(this).html().indexOf(mecesi[i])>=0){
				//console.log(mecesi[i]);
				fecha=$(this).html();
				//console.log( $(this).html().indexOf(mecesi[i]) );
				fecha=fecha.replace(mecesi[i],mecese[i]);
				$(this).html(fecha);
				console.log(fecha);
			}	
			

		}

	});
	




	

});				