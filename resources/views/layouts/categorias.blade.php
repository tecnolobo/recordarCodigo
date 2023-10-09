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
<div class="row">
	
	
</div>
<!--Contenido-->
<div class="container-fluid">
    <div class="row">
       	
       	<!--fomrulario-->
		<form id="miformulario" action="{{ route('buscarPorCategoria',['id_categoria' => $id_categoria]) }}" method="get">
			
			{!! csrf_field() !!}
			
			<div class="input-group">	
		      <span class="input-group-btn">
		      	<button class="btn btn-default" type="button" onclick="window.location.href='{{ URL::asset('/recordatorio') }}'" >
		          <i class="fa fa-plus"></i> &nbsp
		        </button>  
		      </span>
		      <!-- <input type="hidden" name="id_categoria" value="{{$id_categoria}}" > -->
					<input type="text" name="buscar" onkeydown="javascript:enviarFormuarioConEnter(event,'#miformulario')" class="form-control" placeholder="Por nombre o descripsion">
		      <span class="input-group-btn">
		         <input type="submit" name="Go!" value="Go!" class="btn btn-default"  type="button"> 
		      </span>
		    </div><!-- /input-group -->

		</form><!--fin fomrulario-->
	
		<br>
    </div>
	

    <div class="row">

    	<!--Mensajes de session-->
		@if(Session::has('mensaje'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Session::get('mensaje')}}
			</div>
		@endif

    	@if(Session::has('busqueda'))
			{!!Session::get('busqueda')!!}
			<br>
		@endif	
		<!--/Mensajes de session-->
    </div>

    <!--Lo mas reciente-->
    <div class="row reciente">
    	<div class="row">
			
			<div class="col-md-12">

			  <!-- Nav tabs -->
			  <ul id="myTabs" class="nav nav-tabs pestanas" role="tablist">
			    <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">{{$nombre}}</a></li>
			  </ul><!-- /Nav tabs -->
			
			</div>	
	  

			<!-- Tab panes -->
			<div class="tab-content col-md-12">
				
				<br>
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
					                    	<a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('editarCodigo/'.$codigosRecordarhtml[$i][$j]->id) }}" >Editar</a>
					                    	<a class="btn btn-default btn-xs hidden-portatil hidden-cel hidden-netbok hidden-mds papa" href="javascript:void(0)" role="button" data-placement="top" data-toggle="popover" title="{{ $codigosRecordarhtml[$i][$j]->nombre }}" data-content="{{ $codigosRecordarhtml[$i][$j]->descripsion }}"><i class="fa fa-angle-double-up fa-lg" aria-hidden="true"></i></a>
					                        
					                        <a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('showCodigo/'.$codigosRecordarhtml[$i][$j]->id) }}">Leer</a>
					                        <a class="btn btn-danger visible-tbl hidden-xxs" onclick="eliminarRecordatorio('{{ URL::asset('destroyCodigoHtml/'.$codigosRecordarhtml[$i][$j]->id) }}','{{ $codigosRecordarhtml[$i][$j]->id }}')">Eliminar</a>
											<a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('editarCodigo/'.$codigosRecordarhtml[$i][$j]->id) }}" >Editar</a>
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
							<div class="margin-top-50px paghtml">{!! $paginadorcategorias->render() !!}</div>
						</div>
					</div>
					<!--/Paginacion-->
					
				</div>
				<!--/Codigos html css java etc-->



			</div><!--/tabs panes-->

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