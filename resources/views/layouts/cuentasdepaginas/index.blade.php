@extends('misCuentasDepaginasMaster')

@section('title')
	Home - Mis cuentas de paginas
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
	@foreach ($resientes as $resiente)
		<li>
			<a title="{{ $resiente->url }}" href="{{ $resiente->url }}" target="blank">
			<span class="fa fa-caret-right"></span>{{ $resiente->nombre_pagina }}
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

@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-6 col-sm-3">
			</div>
		</div>
		<div class="margin-top-15px"></div>

		<div class="row">
			<div class="col-md-12"> 
				<a href="{{  url('nuevaCuentaDePagina')  }}" class="btn btn-default"><span class="fa fa-plus" aria-hidden="true"></span> Nuevo</a>  &nbsp;
				<a href="" class="btn btn-default"><span class="fa fa-bookmark" aria-hidden="true"></span> Agergar Categoria</a> 
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				&nbsp;
			</div>
		</div>
		

		<!--Todos los registros-->
		@foreach ($todos as $todo)
			
			<div class="row">
				<div class="col-md-12">
					<div class="item_info_pagina">
						<h1>{{ $todo->nombre_pagina	 }}</h1>
						<time datetime="2011-01-12">{{ $todo->created_at }}</time>
						<p>
							{{ $todo->descripsion }}
						</p>
						<p>
							{{ $todo->url }}
						</p>
						<div class="botones">
							<button class="btn btn-default" type="button">Editar</button> <button class="btn btn-danger" type="button">Eliminar</button>
						</div>
					</div>
				</div>
			</div>

		@endforeach
		<!--/todos los registros-->
		

		

	</div>



@stop


