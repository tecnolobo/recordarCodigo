@extends('indexMaster')

@section('title')
Nueva Categoria
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
				<h2 class="margin-top-15px">Nueva Categoria </h2>
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
			<form name="descipsion" enctype="multipart/form-data" method="post" action="{{ url('/categorias/guardarCategoria') }}">
				
				{!! csrf_field() !!}

				<div class="col-md-6 col-sm-6">
					<input name="nombrecategoria" type="text" class="form-control  input-lg"  placeholder="Nombre Categoria">
				</div>
				<div class="visible-xs margin-bottom-15px"></div>
				<div class="col-md-6 col-sm-6">
					<input type="file" name="imagen" class="form-control  input-lg">
				</div>
				<div class="row">
					<div class="col-md-1">
						<h3>Archivos</h3>
					</div>
					<div class="col-md-11 punteado margin-top-40px margin-bottom-30px visible-md visible-lg">
					</div>
				</div>
				
				<div id="archivos">
					<div class="grupo-archivos">
						<div class="col-md-6">
							<input type="text" name="nombre[]" class="form-control  input-lg margin-bottom-20px"  placeholder="Nombre archivo">
						</div>
						<div class="col-md-6 margin-bottom-20px">
							<select name="tipo_archivo[]" id="tipo" class="form-control  input-lg"  placeholder="Tipo de archivo">
								<option value=" ">Seleccione un mimetype</option>

								@foreach ($mime_type_files as $mime_type_file)
										<option  value="{{ $mime_type_file->id }}">{{ $mime_type_file->nombre }}</option>
								@endforeach

							</select>
						</div>	
					</div>
				</div>			
				<div class="col-md-12">
					<button onclick="createElementsTypeFiles()" class="btn btn-info btn-lg btn-block margin-top-20px"  type="button">Más</button>
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
							<button class="btn btn-info btn-lg" type="submit">Guardar Categoria</button>
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

</script>

<script type="text/javascript" src="{{ URL::asset('js/misjs/funciones.js') }}"></script>

@stop