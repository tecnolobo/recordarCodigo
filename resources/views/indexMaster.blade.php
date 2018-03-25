<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>

<head>
<title>@yield('title','sin titulo')</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@yield('palabrasclave')
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/bootstrap/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" media="all"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/miestilo/mio.css') }}">

<!--nuevosCss-->
@yield('nuevoCss')
<!--/nuevosCss-->

</head>
<body >
	<!--Mensajes al usuario-->
		@yield('mensajes')
	<!--Mensajes al usuario-->
	
	<div class="header">
  	  		<div class="wrap">
				<div class="header_top">
					<div class="titulo-pagina">
						<h2 onclick="javascript:window.location.href='{{ URL::asset('/') }}'">

								TECNOLOBO
							
						</h2>

					</div>
						<div class="header_top_right">
							  <div class="search_box">
							  	<span>Buscar</span>
					     		<form>
					     			<input type="text" value="" onblur="alert('assa');"><input type="submit" value="">
					     		</form>
					     		<div class="clear"></div>
					     	</div>
					</div>
			     <div class="clear"></div>
  		    </div>     
  		    <div class="navigation">
  		    	<a class="toggleMenu" href="#">Menu</a>
					<ul class="nav">
						<!--Home-->
						<li>
							<a href="/">Inicio</a>
						</li>
						<!--Aplicaciones-->
						<li  class="test">
							<a href="#">Appliances</a>
							<ul>
								<li>
									<a href="">Nuevo</a>
									<ul>
										<li><a href="/recordatorio">Recordatorio</a></li>
										<li><a href="#">Pressure Cookers</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Storage</a>
									<ul>
										<li><a href="#">Bottles & Sippers</a></li>
										<li><a href="#">Containers & Jars</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Cutlery & Tableware</a>
									<ul>
										<li><a href="#">Cutlery</a></li>
										<li><a href="#">Condiment Sets</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Bar Accessories</a>
									<ul>
										<li><a href="#">Bottle Openers</a></li>
										<li><a href="#">Flasks</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<!--Video-->
						<li>
							<a href="#">Videos</a>
							<ul>
								<li>
									<a href="#">Youtube</a>
									<ul>
										<li><a href="#">HP</a></li>
										<li><a href="#">Lenova</a></li>
										<li><a href="#">Dell</a></li>
										<li><a href="#">All Brands</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Computer Accessories</a>
									<ul>
										<li><a href="#">External Hard Disks</a></li>
										<li><a href="#">Pendrives</a></li>
										<li><a href="#">PC Components</a></li>
										<li><a href="#">Computer Peripherals</a></li>
										<li><a href="#">Datacards & Routers</a></li>
										<li><a href="#">Mouse</a></li>
										<li><a href="#">Laptop Skins & Decals</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<!--Paginas-->
						<li>
							<a href="#">Paginas</a>
							<ul>
								<li><a href="#">Programacion</a></li>
								<li><a href="#">Trabajo</a></li>
								<li><a href="#">Entretenimiento</a></li>
								
							</ul>
						</li>
						<!--Contactenos-->
						<li>
							<a href="contact.html">Contactanos</a>
						</li>
					</ul>
					 <span class="left-ribbon"> </span> 
      				 <span class="right-ribbon"> </span>    
  		    </div>
  		     <div class="header_bottom">
			   <div class="slider-text">
			   	<h2>No recuerdas tu codigo? <br/>Se te olvido como se hace?</h2>
			   	<p>Aqui podras guardar lo que necesiten<br/> Y cuando sea necesesario</p>
			   	<a href="#">Creado por julian gomez</a>
	  	      </div>
	  	      <div class="slider-img">
	  	      	<img src="{{ URL::asset('img/mio.gif')}}" alt="" />
	  	      </div>
	  	     <div class="clear"></div>
	      </div>
   		</div>
   </div>
   <!------------End Header ------------>
  <div class="main">
      <div class="content">
    	        <div class="content_top">
    	        	<div class="wrap">
		          	   <h3 class="h3x">Categorias</h3>
		          	</div>
		          	<div class="line"> </div>
		          	<div class="wrap">
		          	 <div class="ocarousel_slider">  
	      				<div class="ocarousel example_photos" data-ocarousel-perscroll="3">
			                <div class="ocarousel_window">
							@foreach ($imagenes as $imagen)
								<a href="/categoria/{{ $imagen->id_categoria }}" title="{{ $imagen->nombre }}"> <img src="{{ URL::asset($imagen->imagen) }}" alt="" /><p>{{ $imagen->nombre }}</p></a>
							@endforeach

			                </div>
			               <span>           
			                <a href="#" data-ocarousel-link="left" style="float: left;" class="prev"> </a>
			                <a href="#" data-ocarousel-link="right" style="float: right;" class="next"> </a>
			               </span>
					   </div>
				     </div>  
				   </div>    		
    	       </div>
    	  <div class="content_bottom">
    	    <div class="wrap">
    	    	<div class="content-bottom-left">
    	    		@yield('contenidoAbajoizquierda')
    	    	</div>
    	    	
    	    	<div class="content-bottom-right">
    	    		@yield('contenidoAbajoderecha')
		      	</div><!--/content.bottom.right-->

		      <div class="clear"></div>
		   </div>
         </div>
      </div>
    </div>
   <div class="footer">
   	  <div class="wrap">	
			 <div class="copy_right">
				<p>Copy rights (c). All rights Reseverd | Template by  <a href="http://w3layouts.com" target="_blank">W3Layouts</a> </p>
		   </div>	
		   <div class="footer-nav">
		   	<ul>
		   		<li><a href="#">Terms of Use</a> : </li>
		   		<li><a href="#">Privacy Policy</a> : </li>
		   		<li><a href="contact.html">Contact Us</a> : </li>
		   		<li><a href="#">Sitemap</a></li>
		   	</ul>
		   </div>		
        </div>
    </div>
    
    <a href="#" id="toTop"> </a>

    <!--Scripts-->
    <script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery-2.x.js') }}"></script> 
	<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.openCarousel.js') }}" ></script>
	<script type="text/javascript" src="{{ URL::asset('plugins/jquery/bootstrap.js') }}" ></script>

	<script type="text/javascript" src="{{ URL::asset('js/easing.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/navigation.js') }}"></script>

    @yield('nuevojs')
    <!--/Scripts-->

    
</body>

</html>

