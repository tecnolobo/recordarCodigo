@extends('misCuentasDepaginasMaster')

@section('title')
	Home - Mis cuentas de paginas
@stop

@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
@stop


@section('titulo')
	No recuerdas las cuentas <br> Ni donde te as registrado?
@stop

@section('descripsion')
	Aqui puedes encontrar los nombres de usurio
	y los links a esas paginas que no recuerdas 
	haberte registrado 
@stop

@section('contenidoAbajoizquierda')

<br>
<ul class="resientes">
	<h3><span class="fa fa-caret-left"></span>Lo mas reciente</h3>	
	@foreach ($resientes as $resiente)
		<li>
			<a title="{{ $resiente->url }}" href="{{ $resiente->url }}" target="blank">
			<span class="fa fa-caret-right"></span>{{ $resiente->nombre_pagina }}
			</a>
		</li>
	@endforeach
	
</ul>


<br>
<br>	
<br>	
<ul class="resientes categorias">
	<h3><span class="fa fa-caret-left"></span>Categorias</h3>	

	@foreach ($catCuentasDePag as $catCuentaDepag)
		<li>
			<a  id="{{ $catCuentaDepag->id  }}" title="{{ $catCuentaDepag->nombre }}" href="{{ $catCuentaDepag->id }}" target="blank">
			<span class="fa fa-caret-right"></span>{{ $catCuentaDepag->nombre }}
			</a>
		</li>
	@endforeach
	
</ul>

<!--<ul class="resientes">
	<h3><span class="fa fa-caret-right"></span>Lo mas reciente</h3>		
	<li><a href=""><span class="fa fa-caret-right"></span> 1</a></li>
	<li><a href="">2</a></li>
	<li><a href="">3</a></li>
	<li><a href="">4</a></li>
	<li><a href="">5</a></li>
</ul>
-->

@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-6 col-sm-3">
			</div>
		</div>
		<div class="margin-top-15px"></div>

		<div class="row">
			<div class="col-md-12"> 
				<a href="{{  url('nuevaCuentaDePagina')  }}" class="btn btn-default"><span class="fa fa-plus" aria-hidden="true"></span> Nuevo</a>  &nbsp;
				<a href="" class="btn btn-default" data-toggle="modal" data-target="#myModal"><span class="fa fa-bookmark" aria-hidden="true"></span> Agergar Categoria</a> 
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				&nbsp;
			</div>
		</div>
		

		<!--Todos los registros-->
		@foreach ($todos as $todo)
			
			<div class="row">
				<div class="col-md-12">
					<div class="item_info_pagina">
						<h1>{{ $todo->nombre_pagina	 }}</h1>
						<time datetime="2011-01-12">{{ $todo->created_at }}</time>
						<p>
							{{ $todo->descripsion }}
						</p>
						<p>
							{{ $todo->url }}
						</p>
						<div class="botones">
							<button  class="btn btn-default" type="button">Editar</button> 
							<button onclick="eliminar_cuenta_de_pagina('{{ url('destroyCuentaCreada/'.$todo->id) }}')" class="btn btn-danger" type="button">Eliminar</button>
						</div>
					</div>
				</div>
			</div>

		@endforeach
		<!--/todos los registros-->
		

		

	</div>

	<!--Ventana modal para crear categoria-->
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Agragar Categoria</h4>
	      </div>

	      <!--cuerpo modal-->
	      <div class="modal-body">
	      	<div class="row">
	      		<form name="form_categ" id="formulario" method="post" action="">
		        	<div class="col-md-12 col-sm-6">
						<input name="nombre" type="text" class="form-control  input-lg"  placeholder="Nombre">
					</div>
					{!! csrf_field() !!}
	        	</form>
	      	</div>
	      	<br>
	      	<hr>
	      	<!--Fila de etiquetas-->
	      	<div class="row etiqtas_catg_modal margin-top-20px">
	      		<div id="etiqtas_catg" class="col-md-12 sm-md-12">
				

					@foreach ($catCuentasDePagt as $catCuentaDepagt)
						
						<span class="label label-default">{{ $catCuentaDepagt->nombre }}<a href="javascript:void(0)" id="{{ $catCuentaDepagt->id }}"> x</a></span>

					@endforeach 


	      		</div>
	      		<br>
	      	</div>
	      </div>
	      <!--/Fila de etiquetas-->
	
	      <div class="modal-footer">
	        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
	        <button id="btn-send" onclick="crearCatCuentaDePag()"  type="button" class="btn btn-primary">Guardar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@stop

<!--AJAX-->

@section('nuevojs')
	
	<script type="text/javascript" src="{{ URL::asset('js/misjs/mis_cuentas_de_pagina.js') }}"></script>

	<script type="text/javascript">
		/*
		funciones utilizadas 
		crearCatCuentaDePag

		*/

		// eliminar categorias con un click
		$(document).ready(function() {

			//eliminar catCuentaDePagina
			$('#etiqtas_catg').delegate('span a', 'click', function(){
				var id, datos;
				var datos=$('#formulario').serialize();
				//console.log('ss'+'{{ csrf_token() }}');
				id=$(this).attr('id');

				if(confirm('desea realmente eliminar este registro')){


					$.ajax({
	                data:  '_token={{ csrf_token() }}&id='+id,
	                url:   'destroyCateCuentaDePag',
	                type:  'post',
	                beforeSend: function () {
	                       // $("#resultado").html("Procesando, espere por favor...");
	                       console.log("enviado espera...");

	                },
	                success:  function (data) {
	                		//data-- es la respuesta del servidor
	                		
	                		switch(data.estado){
	                			case 0:

	                				//se pone de color el elemento y se esconde
	                				$('a[id='+data.id+']').parent("span").css('background-color', 'red');
	                				$('ul.resientes.categorias a[id='+data.id+']').css('background-color', 'red');
	                				$('a[id='+data.id+']').parent("span").toggle(2500);
	                				$('ul.resientes.categorias a[id='+data.id+']').parent('li').toggle(2500);


	                				alert(data.ms);

	                			break;

	                			case 1:
	                				alert(data.ms);
	                			break;
	                		}


	                	}
	        		});

        		}// /if

			});
			// /eliminar catCuentaDePagina
		});

	</script>
@stop

