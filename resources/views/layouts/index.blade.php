@extends('indexMaster')

@section('palabrasclave')
<meta name="description" content="Crear recordatorios functiones o fragmentos de codigos para poder buscarlos e utilizarlos mas rapido en tus proyectos de Programacion" /> 
<meta name="keywords" content="codigo, recordar, fragmentos, funciones" /> 
@stop

@section('title')
Home Recordatorios
@stop


@section('nuevoCss')
<link href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/miestilo/pantallas_mediaqueris.css') }}">
@stop


@section('contenidoAbajoizquierda')
	iiiiii
@stop

@section('contenidoAbajoderecha')
<h3 class="h3x">
    Lo Actualmente Reciente
</h3>
<!--Contenido-->
<div class="container-fluid">
    <div class="row">
        	
		<div class="input-group">
	      <span class="input-group-btn">
	      	<button class="btn btn-default" type="button" onclick="window.location.href='{{ URL::asset('/recordatorio') }}'" >
	          <i class="fa fa-plus"></i> &nbsp
	        </button>  
	      </span>
	      <input type="text" class="form-control" placeholder="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button">Go!</button>  
	      </span>

	    </div><!-- /input-group -->
	

    </div>

    <div class="row">
        <div class="row margin-bottom-20px">
        	<!--Mensajes de session-->
			@if(Session::has('mensaje'))
				<br>
				<div class=" col-md-12 alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{Session::get('mensaje')}}
				</div>
			@endif
			<!--/Mensajes de session-->
        </div>
    </div>

    <!--Lo mas reciente-->
    <div class="row reciente">
    	<div class="row">

    		<div>

			  <!-- Nav tabs -->
			  <ul id="myTabs" class="nav nav-tabs pestanas" role="tablist">
			    <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
			    <li role="presentation"><a href="#laravel"  role="tab" data-toggle="tab">Laravel</a></li>
			  </ul><!-- /Nav tabs -->

			  <!-- Tab panes -->
			  <div class="tab-content col-md-12">
				<br>
				
				<!--Codgiso html css java etc-->

			    <div role="tabpanel" class="tab-pane active" id="home">

			    	@for ($i=0; $i< count($codigosRecordarhtml); $i++)

			        	<div class="row">

					        @for ($j = 0; $j <count($codigosRecordarhtml[$i]) ; $j++)
					        	<div class="col-sm-4 col-md-4 col-xs-12">
					            <div class="thumbnail">
					                <div class="caption">
					                    <h3 title="{{ $codigosRecordarhtml[$i][$j]->nombre }}">{{ $codigosRecordarhtml[$i][$j]->nombre }}</h3>
					                    <time class="tiempo"> {{ date('d F Y', strtotime( $codigosRecordarhtml[$i][$j]->created_at)) }}</time>
					                    <p class="">{{ $codigosRecordarhtml[$i][$j]->descripsion }}</p>
					                    <br class="">
					                    <p>
					                        <a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('showCodigo/'.$codigosRecordarhtml[$i][$j]->id) }}">Leer</a>
					                        <a class="btn btn-danger  btn-xs hidden-tbl hidden-portatil hidden-netbok visible-tbl  hidden-cel hidden-mds" role="button" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoHtml/'.$codigosRecordarhtml[$i][$j]->id )}}')">Eliminar</a>
					                    	<a class="btn btn-default btn-xs hidden-portatil hidden-cel hidden-netbok hidden-mds papa" href="javascript:void(0)" role="button" data-placement="top" data-toggle="popover" title="{{ $codigosRecordarhtml[$i][$j]->nombre }}" data-content="{{ $codigosRecordarhtml[$i][$j]->descripsion }}"><i class="fa fa-angle-double-up fa-lg" aria-hidden="true"></i></a>
					                        <a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('showCodigo/'.$codigosRecordarhtml[$i][$j]->id) }}">Leer</a>
					                        <a class="btn btn-danger visible-tbl hidden-xxs" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoHtml/'.$codigosRecordarhtml[$i][$j]->id) }}','{{ $codigosRecordarhtml[$i][$j]->id }}')">Eliminar</a>
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
							<div class="margin-top-50px paghtml">{!! $paginadorhtml->render() !!}</div>
						</div>
					</div>
					<!--/Paginacion-->
					
			    </div>
			    <!--/Codigos html css java etc-->
				
				<!--Laravel codigos-->
			    <div role="tabpanel" class="tab-pane" id="laravel">
			    	@for ($i=0; $i< count($codigosRecordarlaravel); $i++)

			        	<div class="row">

					        @for ($j = 0; $j <count($codigosRecordarlaravel[$i]) ; $j++)
					        	<div class="col-sm-4 col-md-4 col-xs-12">
					            <div class="thumbnail">
					                <div class="caption">
					                    <h3 title="{{ $codigosRecordarlaravel[$i][$j]->nombre }}">{{ $codigosRecordarlaravel[$i][$j]->nombre }}</h3>
					                    <time class="tiempo">{{ date('d F Y', strtotime( $codigosRecordarlaravel[$i][$j]->created_at)) }}</time>
					                    <p class="">{{ $codigosRecordarlaravel[$i][$j]->descripsion }}</p>
					                    <br class="">
					                    <p>
					                        <a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('showCodigoLaravel/'.$codigosRecordarlaravel[$i][$j]->id) }}">Leer</a>
					                        <a class="btn btn-danger  btn-xs hidden-tbl hidden-portatil hidden-netbok visible-tbl  hidden-cel hidden-mds" role="button" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoHtml/'.$codigosRecordarlaravel[$i][$j]->id )}}')">Eliminar</a>
					                    	<a class="btn btn-default btn-xs hidden-portatil hidden-cel hidden-netbok hidden-mds papa" href="javascript:void(0)" role="button" data-placement="top" data-toggle="popover" title="{{ $codigosRecordarlaravel[$i][$j]->nombre }}" data-content="{{ $codigosRecordarlaravel[$i][$j]->descripsion }}"><i class="fa fa-angle-double-up fa-lg" aria-hidden="true"></i></a>
					                        <a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('showCodigoLaravel/'.$codigosRecordarlaravel[$i][$j]->id) }}">Leer</a>
					                        <a class="btn btn-danger visible-tbl hidden-xxs" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoHtml/'.$codigosRecordarlaravel[$i][$j]->id) }}')">Eliminar</a>
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
							<div class="margin-top-50px paglaravel">{!! $paginadorlaravel->render() !!}</div>
						</div>
					</div>
					<!--/Paginacion-->


			    </div>
			    <!--Laravel codigos-->

			  </div><!--/tabs panes-->

			</div>

    	</div>

    </div>
   

</div>
<div class="container-fluid">
	
</div>
@stop


@section('nuevojs')
    <script type="text/javascript">
        $(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			$('.papa').popover();
		});
    </script>
    <script src="{{ URL::asset('js/misjs/funciones.js') }}" type="text/javascript">
    </script>
    @stop
</link>