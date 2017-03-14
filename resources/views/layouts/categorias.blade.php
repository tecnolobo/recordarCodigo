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
				<i class="fa fa-reply fa-3x" aria-hidden="true"></i>
			</div>
			<div class="col-md-6 col-sm-3">
				<h2 class="margin-top-15px">Nuevo Recordatorio </h2>
			</div>
			
		</div>
		
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
						<option value="0">Selecione Tipo</option>
						<option value="html">Texto Html</option>
						<option value="laravel">Laravel</option>
						<option value="htmlycss">Html y Css</option>
						<option value="apphtml">App Html</option>
						<option value="javascript">Javascript</option>
						<option value="php">Php</option>
						<option value="jquery">Jquery</option>
					</select>
				</div>

				<div class="col-md-12 margin-top-30px">
					<textarea class="form-control  input-lg height-200" name="descripsion" placeholder="Descripsion"></textarea>
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

					<div id="html" class="row margin-top-20px margin-bottom-50px codeitem">
						<div class="col-md-1"></div>
						<!--Textarea Html-->
						<div  class="col-md-10">
							<div name="html" class="btn btn-info eliminar-textarea ">x</div>
							<div name="html" class="btn btn-info eliminar-textarea visible-xs ">x</div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="font-size-30 margin-bottom-10px">Html</h2>
								</div>
							</div>
							<textarea class="form-control  input-lg height-200" name="html"></textarea>
						</div>
						<!--/Textarea Html-->

						<div class="col-md-1"></div>
					</div>

					<!--Css-->
					<div id="css" class="row codeitem margin-bottom-50px">
						<div class="col-md-1"></div>
						<!--Textarea Css-->
						<div  class="col-md-10 ">
						<div name="css" class="btn btn-info eliminar-textarea ">x</div>
						<div name="css" class="btn btn-info eliminar-textarea visible-xs ">x</div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="font-size-30 margin-bottom-10px">Css</h2>
								</div>
							</div>
							<textarea class="form-control  input-lg height-200" name="css"></textarea>
						</div>
						<!--/Textarea Css-->
						<div class="col-md-1"></div>								
					</div>

					<!--Php-->
					<div id="php" class="row codeitem margin-bottom-50px">
						<div class="col-md-1"></div>	
						<!--Textarea Php-->
						<div  class="col-md-10 ">
							<div name="php" class="btn btn-info eliminar-textarea ">x</div>
							<div name="php" class="btn btn-info eliminar-textarea visible-xs ">x</div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="font-size-30 margin-bottom-10px">Php</h2>
								</div>
							</div>
							<textarea class="form-control  input-lg height-200" name="php"></textarea>
						</div>
						<!--/Textarea Php-->
						<div class="col-md-1"></div>		
					</div>

					<!--Javascript-->
					<div id="javascript"  class="row codeitem margin-bottom-50px">
						<div class="col-md-1"></div>
						<!--Textarea Javascript-->
						<div class="col-md-10 ">
							<div name="javascript"  class="btn btn-info eliminar-textarea ">x</div>
							<div name="javascript" class="btn btn-info eliminar-textarea visible-xs ">x</div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="font-size-30 margin-bottom-10px">JavaScript</h2>
								</div>
							</div>
							<textarea class="form-control  input-lg height-200" name="javascript"></textarea>
						</div>
						<!--/Textarea Javascript-->
						<div class="col-md-1"></div>		
					</div>
					
					<!--Jquery-->
					<div id="jquery" class="row codeitem margin-bottom-50px">
						<div class="col-md-1"></div>	
						<!--Textarea Jquery-->
						<div  class="col-md-10 ">
							<div name="jquery" class="btn btn-info eliminar-textarea">x</div>
							<div name="jquery" class="btn btn-info eliminar-textarea visible-xs ">x</div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="font-size-30 margin-bottom-10px">Jquery</h2>
								</div>
							</div>
							<textarea class="form-control  input-lg height-200" name="jquery"></textarea>
						</div>
						<!--/Textarea Jquery-->
						<div class="col-md-1"></div>	
					</div>


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