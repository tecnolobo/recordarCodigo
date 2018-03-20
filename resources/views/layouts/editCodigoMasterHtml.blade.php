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
		
			<form action="">

				@for ($i = 0; $i <count($datos[1]) ; $i++)

					

					
					@if ($codigo[0]->$datos[1][$i] !="")

						<div class="col-md-12 col-xs-12">
							<h1 class="titulo grande">{{ $datos[1][$i] }}</h1>
						</div>
						<!--html-->
						<div class="col-md-12 col-xs-12" style="margin-top: 0px;  margin-bottom: 32px; font-size: 15px;">
							
							<br>

							@if ($datos[1][$i] =='jquery')
								  <?php $datos[1][$i]='javascript'; ?>
							@endif

							<!--Aqui el id del elemento le agregamos la variable $i para hacerlo unico-->
							<textarea name="n" id="{{$datos[1][$i].$i }}" >{{ $codigo[0]->$datos[1][$i] }}</textarea>

						</div>
					@endif
					
				

				@endfor

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