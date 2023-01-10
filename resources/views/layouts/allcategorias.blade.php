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

@section('content_top')
  
@stop

@section('contenidoAbajoizquierda')
	aaaaaaaaaa
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
		<form id="miformulario" action="{{ url('buscar') }}" method="post">
			
			{!! csrf_field() !!}
			
			<div class="input-group">	
		      <span class="input-group-btn">
		      	<button class="btn btn-default" type="button" onclick="window.location.href='{{ URL::asset('/categorias/nuevo') }}'" >
		          <i class="fa fa-plus"></i> &nbsp
		        </button>  
		      </span>
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

			 
			</div>	
	  

			<!-- Tab panes -->
			<div class="tab-content col-md-12">
				
				<br>
				<br>

				<!--Codgiso html css java etc-->

				<div role="tabpanel" class="tab-pane active" id="home">
					
					@for ($i=0; $i< count($categoriasStructure); $i++)

				    	<div class="row">

					        @for ($j = 0; $j <count($categoriasStructure[$i]) ; $j++)
					        	<div class="col-sm-4 col-md-4 col-xs-12">
					            <div class="thumbnail">
					                <div class="caption">
					                    <h3 title="{{ $categoriasStructure[$i][$j]->nombre }}">{{ $categoriasStructure[$i][$j]->nombre }}</h3>
					                    <p class="">{{ $categoriasStructure[$i][$j]->descripsion }}</p>
					                    <br class="">
					                    <p>
					                        <a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('detalleCategoria/'.$categoriasStructure[$i][$j]->id_categoria) }}">Ver</a>
					                        <a class="btn btn-danger  btn-xs hidden-tbl hidden-portatil hidden-netbok visible-tbl  hidden-cel hidden-mds" role="button" onclick="eliminarCategoria('{{ URL::asset('destroyCodigoHtml/'.$categoriasStructure[$i][$j]->id_categoria )}}')">Eliminar</a>
					                    	<a class="btn btn-default btn-xs hidden-tbl hidden-portatil hidden-netbok hidden-mds hidden-cel" href="{{ URL::asset('editarCategoria/'.$categoriasStructure[$i][$j]->id_categoria) }}" >Editar</a>
					                    	<a class="btn btn-default btn-xs hidden-portatil hidden-cel hidden-netbok hidden-mds papa" href="javascript:void(0)" role="button" data-placement="top" data-toggle="popover" title="{{ $categoriasStructure[$i][$j]->nombre }}" data-content="{{ $categoriasStructure[$i][$j]->descripsion }}"><i class="fa fa-angle-double-up fa-lg" aria-hidden="true"></i></a>
					                        
					                        <a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('detalleCategoria/'.$categoriasStructure[$i][$j]->id_categoria) }}">Ver</a>
					                        <a class="btn btn-danger visible-tbl hidden-xxs" onclick="eliminarCategoria('{{ URL::asset('destroyCategoria/'.$categoriasStructure[$i][$j]->id_categoria) }}','{{ $categoriasStructure[$i][$j]->id_categoria }}')">Eliminar</a>
											<a class="btn btn-default visible-tbl hidden-xxs" href="{{ URL::asset('editarCategoria/'.$categoriasStructure[$i][$j]->id_categoria) }}" >Editar</a>
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