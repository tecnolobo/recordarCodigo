<?php
/*echo json_encode($estructuraCategoria);
exit;*/

?>
@extends('indexMaster')

@section('title')
Recordatorio
@stop


@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
	
	<!--Css para el editor de texto-->	
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/codemirrorV5/lib/codemirror.css')}}">
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/codemirrorV5/theme/monokai.css')}}">
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/codemirrorV5/addon/display/fullscreen.css')}}">
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
		
			<form action="{{url('actualizarCodigoMasterHtml')}}" id="editandoRecordatorio" method="post">
				
				{!! csrf_field() !!}
				        
				<!--------------------------------------------------------------->
			@for ($i = 0; $i <count($estructuraCategoria->tipos_archivos) ; $i++)

				@php 
					$name_lenguach = $estructuraCategoria->tipos_archivos[$i]->extension_archivo; 
					$contador = $i+1;
					$name_column =  $estructuraCategoria->tipos_archivos[$i]->nombre_column;
				@endphp	

				@if ($codigo[0]->$name_column !="")
					<!--html-->
					<div class="col-md-12 col-xs-12">
						<h1 class="titulo grande">{{ $estructuraCategoria->tipos_archivos[$i]->nombre }}</h1>
						<br>
					</div>

					<div class="col-md-12 col-xs-12" style="margin-top: 0px;  margin-bottom: 32px; font-size: 15px;">

						@if ($name_lenguach =='jquery')
							  <?php $name_lenguach='javascript'; ?>
						@endif

						<!--Aqui el id del elemento le agregamos la variable $i para hacerlo unico-->
						<textarea  name="{{$estructuraCategoria->tipos_archivos[$i]->nombre_column }}" id="{{ $estructuraCategoria->tipos_archivos[$i]->nombre_column}}" >{{  $codigo[0]->$name_column }}</textarea>
						
					</div>
				@endif

			@endfor

				<div class="cold-md-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 ">
							
						</div>
						<div class="col-md-2 margin-bottom-15px">
							<input onclick="EncodeDataForm('editandoRecordatorio','s')" name="Guardar" value="Guardar" class="btn btn-default btn-block btn-md">
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


<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/lib/codemirror.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/mode/javascript/javascript.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/mode/css/css.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/mode/xml/xml.js') }}"></script>

<!--Modos o mimetype de codemirror-->
@for ($i = 0; $i < count($estructuraCategoria->tipos_archivos) ; $i++)

	@php 
		$the_uri =  $estructuraCategoria->tipos_archivos[$i]->modo."/".$estructuraCategoria->tipos_archivos[$i]->modo.".js";
	@endphp	
	<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/mode/') }}/{{$the_uri}}"></script>
		

@endfor

<script type="text/javascript" src="{{ URL::asset('plugins/codemirrorV5/mode/clike/clike.js') }}"></script>



<!--Fucnionalidad de pantalla completa del edito con F11-->
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/display/fullscreen.js') }}"></script>

<!--Functionalidad de auto cerrado de tags html-->
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/fold/xml-fold.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/codemirror/addon/edit/closetag.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/misjs/misfunciones_mirror.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/misjs/funciones.js') }}"></script>
	

<script>
	//se guarda todas las instancia creadas en una variable(instanciaCodemirror) para poder ser modificadas en cualquier parte del programa
	instanciaCodemirror = [];
	objetoIndividual = {};

	@for ($i = 0; $i < count($estructuraCategoria->tipos_archivos) ; $i++)
		
		@php 
			$name_column =  $estructuraCategoria->tipos_archivos[$i]->nombre_column;
		@endphp	
		
		@if ($codigo[0]->$name_column !="")	
				objetoIndividual = declararelementosmirrorThtml('{{ $estructuraCategoria->tipos_archivos[$i]->extension_archivo }}','{{ $estructuraCategoria->tipos_archivos[$i]->nombre_column}}')	;		
				instanciaCodemirror.push(objetoIndividual);
		@endif
	@endfor
    
</script>


@stop