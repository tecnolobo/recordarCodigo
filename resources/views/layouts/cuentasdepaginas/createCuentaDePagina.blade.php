@extends('misCuentasDepaginasMaster')

@section('title')
	Crear nueva Cuenta de Pagina
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
<ul class="resientes">
	<h3><span class="fa fa-caret-left"></span>Categorias</h3>	
	@foreach ($catCuentasDePag as $catCuentaDepag)
		<li>
			<a title="{{ $catCuentaDepag->nombre }}" href="{{ $catCuentaDepag->id }}" target="blank">
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

<script  async="async" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- tecnolobo2 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1512820407064292"
     data-ad-slot="1266115969"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<a class="atras" href="http://localhost:8000/" title="Atras"><i class="fa fa-reply fa-3x" aria-hidden="true"></i></a><h1>Datos de pagina</h1>
				<div class="margin-bottom-30px"></div>

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

				<!--Mensajes de confirmacion-->
				@if(Session::has('mensaje'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('mensaje')}}
					</div>
				@endif
				<!--/Mensajes de confirmacion-->

			</div>
		</div>

		<!--Formulario-->
		<form class="cuentasDePagina" name="cuentasDePagina" action="{{ url('nuevaCuentaDePagina')}}"  method="post" accept-charset="utf-8">
		
		<div class="row">
			<div class="col-md-5">
				

						
						<div class="form-group">
							<input name="nombrePagina" class="form-control input-lg" type="text"  placeholder="Nombre Pagina">
						</div>

						<br class="hidden-xs">

						<div class="form-group">
							<input name="url" class="form-control input-lg" type="text"  placeholder="Http://www.pagina.com">
						</div>

						<br class="hidden-xs">

						<div class="form-group">
							<input name="usuario" class="form-control input-lg" type="text" placeholder="Usuario Creado">
						</div>

						<br class="hidden-xs">
						
						<div class="form-group">
							<select name="categoria" data-placeholder="Choose a Country..." class="form-control input-lg">
								<option value="0" ><span style="color:red">Selecione</span></option>
								<option value="0" ><span style="color:red">Selecione</span></option>
								
							</select>
						</div>
						<br>

						{!! csrf_field() !!}
				

			</div>

			<div class="col-md-7">

					<div class="form-group">
					<label>Descripsion</label>
					<textarea name="descripsion" class="form-control input-lg" placeholder="Descripsion"></textarea>
					</div>

			</div>

		</div>
		
		<div class="row">

			<div class="col-md-5">
				<!--Boton enviar de formulacio-->
					<div class="form-group text-center">
						<button type="submit" class="btn btn-success btn-lg">Guardar datos</button>
					</div>
				<!--/ Boton enviar de formulacio-->	
			</div>

			<div class="col-md-7">
			</div>

		</div>


		</form>
		<!--/Formulario-->

	</div>
	
@stop


