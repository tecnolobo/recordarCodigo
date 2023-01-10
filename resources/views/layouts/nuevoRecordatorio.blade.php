<?php 
//dd($estructucaCategorias);
?>
@extends('indexMaster')

@section('title')
Nuevo recordatorio
@stop


@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
@stop


@section('contenidoAbajoizquierda')
	iiiiii
@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid margin-bottom-20px">

		<div class="row">
			<div class="col-md-12">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-1">
				<a class="atras" href="{{ URL::asset('/') }}" title="Atras"><i class="fa fa-reply fa-3x" aria-hidden="true"></i></a>
			</div>
			<div class="col-md-6 col-sm-3">
				<h2 class="margin-top-15px">Nuevo Recordatorio </h2>
			</div>
		
		</div>
		<div class="margin-top-15px"></div>
		<!--Mensajes de error para formulario-->
		@if (count($errors) > 0)

			<!--Movemos el scroll automatico-->
			<script type="text/javascript">

				setTimeout(function(){

					$(document).ready(function(){
						var posicion = $('.content-bottom-right').offset().top;
					    $("html, body").animate({
					        scrollTop: posicion
					    }, 2000); 
					});

				}, 1000);

			</script>

		    <div class="alert alert-danger">
		    	<h4>Porfavor corriga los errores</h4>
		    	<br>
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<!--/Mensajes de error para formulario-->

		<!--Mensajes de session-->
		@if(Session::has('mensaje'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Session::get('mensaje')}}
			</div>
		@endif
		<!--/Mensajes de session-->
		
		<div class="row">
			<div class="col-md-12 margin-top-15px"></div>
		</div>

		<div class="row">
			<!--Inicio formulario-->
			<form name="descipsion" method="post" action="{{ url('guardarRecordatorio') }}">
				
				{!! csrf_field() !!}

				<div class="col-md-6 col-sm-6">
					<input name="nombre" type="text" class="form-control  input-lg"  placeholder="Nombre">
				</div>
				<div class="visible-xs margin-bottom-15px"></div>
				<div class="col-md-4 col-sm-4">
					<select name="tipo" id="tipo" class="form-control  input-lg" name="tipo" >
						<option value=" ">Selecione Tipo</option>

						@foreach ($categorias as $categoria)
								<option  value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
						@endforeach
						<!--
						<option value="0">Selecione Tipo</option>
						<option value="html">Texto Html</option>
						<option value="laravel">Laravel</option>
						<option value="htmlycss">Html y Css</option>
						<option value="apphtml">App Html</option>
						<option value="javascript">Javascript</option>
						<option value="php">Php</option>
						<option value="jquery">Jquery</option>
						-->
					</select>
				</div>

				<div class="col-md-12 margin-top-30px">
					<textarea class="form-control  input-lg height-200" name="descripsion" placeholder="Descripsion"></textarea>
				</div>
				
				<div class="col-md-12 text-center">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4 margin-top-30px">
							{!! Recaptcha::render([ 'lang'  =>  'es' ]) !!}
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>

				<div class="col-md-12 text-center">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4 margin-top-30px">
							<button class="btn btn-info btn-lg" type="submit">Guardar codigo</button>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
				<div class="col-md-12 punteado margin-top-40px margin-bottom-10px visible-md visible-lg">
					
				</div>
				
				<!--Codigo-->
				<div class="col-md-12" id="codigo">


				</div>
				<!--/codigo-->

			<!--/Fin formulario-->
			</form>
		</div>

	</div><!--/container fluid-->
@stop


@section('nuevojs')

<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});

	@php 
		
		echo "var estructureCategory = '".json_encode($estructucaCategorias)."';";
		
	@endphp	
		
		estructureCategory = JSON.parse(estructureCategory);


</script>

<script type="text/javascript" src="{{ URL::asset('js/misjs/funciones.js') }}"></script>

@stop