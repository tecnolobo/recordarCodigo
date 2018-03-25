@extends('indexMaster')

@section('title')
Recordatorio
@stop


@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
	
	<!--Css para el editor de texto-->	
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/css/codemirror/codemirror.css')}}">
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/css/codemirror/theme/monokai.css')}}">
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/codemirror/addon/display/fullscreen.css')}}">
@stop

@section('mensajes')
	
	
	@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom:0px !important">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{Session::get('success')}}
		</div>
	@endif

	@if(Session::has('error'))
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom:0px !important">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Session::get('error')}}
		</div>
		
		<br>
	@endif	
			

@stop


@section('contenidoAbajoizquierda')
	iiiiii
@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid margin-bottom-20px">
		<div class="row">
			<div class="col-md-12"><h1 class="titulo">{{ $codigo[0]->nombre }}</h1></div>
		</div>
		<div class="row">
			<div class="col-md-12"><br><br></div>
		</div>

		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h2>Descripcion</h2>
				<p>
					{{ $codigo[0]->descripsion }}
				</p>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row ">
			<div class="col-md-12 margin-top-40px">
				
			</div>
		</div>
		
		
		<!--Codigos-->
		<div class="row codigos">
		
			<form action="{{url('actualizarCodigoMasterHtml')}}" method="post">
				
				{!! csrf_field() !!}

				@for ($i = 0; $i <count($datos[1]) ; $i++)

					

					
					@if ($codigo[0]->$datos[1][$i] !="")

						<div class="col-md-12 col-xs-12">
							<h1 class="titulo grande">{{ $datos[1][$i] }}</h1>
						</div>
						<!--html-->
						<div class="col-md-12 col-xs-12" style="margin-top: 0px;  margin-bottom: 32px; font-size: 15px;">
							
							<br>

							@if ($datos[1][$i] =='jquery')
								
								@php
								    $tipo='jquery';
								@endphp
								

							@else

								@php
						     		$tipo=$datos[1][$i];
						     	@endphp

							@endif

							<!--Aqui el id del elemento le agregamos la variable $i para hacerlo unico-->
							<textarea  name="{{ $tipo }}" id="{{ $tipo.$i }}" >{{ $codigo[0]->$datos[1][$i] }}</textarea>

						</div>
					@endif
					
				

				@endfor

				<div class="cold-md-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 ">
							
						</div>
						<div class="col-md-2 margin-bottom-15px">
							<input type="submit" name="Guardar" value="Guardar" class="btn btn-default btn-block btn-md">
						</div>
					</div>
					

					<input type="hidden" name="id" value="{{ $id }}">
				</div>
				

			</form>
			

		</div>
		<!--/codigos-->
		
		
		

	</div><!--/container fluid-->
@stop


@section('nuevojs')

<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});

</script>


<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/codemirror.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/javascript/javascript.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/css/css.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/php/php.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/mode/clike/clike.js') }}"></script>

<!--Fucnionalidad de pantalla completa del edito con F11-->
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/display/fullscreen.js') }}"></script>

<!--Functionalidad de auto cerrado de tags html-->
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/fold/xml-fold.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/edit/closetag.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/misjs/misfunciones_mirror.js') }}"></script>

<script>

	@for ($i = 0; $i <count($datos[1]) ; $i++)

		@if ($codigo[0]->$datos[1][$i] !="")
				
				declararelementosmirrorThtml('{{ $datos[1][$i] }}','{{ $i }}')	;		
						
		@endif

	@endfor
    
</script>

@stop