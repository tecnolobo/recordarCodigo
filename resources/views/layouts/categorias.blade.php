@extends('indexMaster')

@section('title')
Nuevo recordatorio
@stop

@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/miestilo/pantallas_mediaqueris.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
@stop


@section('contenidoAbajoizquierda')
	iiiiii
@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid margin-bottom-20px categoria">
		<div class="row">
			<div class="col-md-12">
				<h1 class="titulo">{{ $categoria[0]->nombre }}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><br><br></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p class=descripsion>{{ $categoria[0]->descripsion }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 margin-bottom-60px"></div>
		</div>
		<div>
			
		
		<div class="row">
			
				<div class="row">
					<div class="col-md-12">

						<!--Laravel codigos-->
					    <div role="tabpanel" class="tab-pane" id="laravel">
					    	@for ($i=0; $i< count($coleciones); $i++)

					        	<div class="row">

							        @for ($j = 0; $j <count($coleciones[$i]) ; $j++)
							        	<div class="col-sm-4 col-md-4 col-xs-12">
							            <div class="thumbnail">
							                <div class="caption">
							                    <h3 title="{{ $coleciones[$i][$j]->nombre }}">{{ $coleciones[$i][$j]->nombre }}</h3>
							                    <time class="tiempo">{{ date('d F Y', strtotime( $coleciones[$i][$j]->created_at)) }}</time>
							                    <p class="">{{ $coleciones[$i][$j]->descripsion }}</p>
							                    <br class="">
							                    <p>
							                        <a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('showCodigoLaravel/'.$coleciones[$i][$j]->id) }}">Leer</a>
							                        <a class="btn btn-danger  btn-xs hidden-tbl hidden-portatil hidden-netbok visible-tbl  hidden-cel hidden-mds" role="button" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoLaravel/'.$coleciones[$i][$j]->id )}}')">Eliminar</a>
							                    	<a class="btn btn-default btn-xs hidden-portatil hidden-cel hidden-netbok hidden-mds papa" href="javascript:void(0)" role="button" data-placement="top" data-toggle="popover" title="{{ $coleciones[$i][$j]->nombre }}" data-content="{{ $coleciones[$i][$j]->descripsion }}"><i class="fa fa-angle-double-up fa-lg" aria-hidden="true"></i></a>
							                        <a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('showCodigoLaravel/'.$coleciones[$i][$j]->id) }}">Leer</a>
							                        <a class="btn btn-danger visible-tbl hidden-xxs" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoLaravel/'.$coleciones[$i][$j]->id) }}')">Eliminar</a>
							                    </p>
							                </div>
							            </div>
							        </div>
							        @endfor

						        </div>

					        @endfor
							
							<!--Paginacion-->
							<div class="row">
								<div class="col-md-12 text-center">
									<div class="margin-top-50px paglaravel">{!! $paginador->render() !!}</div>
								</div>
							</div>
							<!--/Paginacion-->


					    </div>
					    <!--Laravel codigos-->

					</div>
				</div>
			
		</div>
		</div>
	</div><!--/container fluid-->
@stop


@section('nuevojs')
<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			$('.papa').popover();
		});

</script>

<script type="text/javascript" src="{{ URL::asset('js/misjs/funciones.js') }}"></script>

@stop