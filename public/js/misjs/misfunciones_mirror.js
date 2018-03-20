function declararelementosmirrorThtml(id,incrementado){

	

	//verificamos que tipo de editor usaremos
	switch(id) {
	    case 'html':

	        tipo ="text/html";
	        break;

	    case 'laravel':

	        tipo ="text/html";
	        break;

	    case 'css':

	        tipo ="text/css";
	        break;

	    case 'php':

	        tipo ="application/x-httpd-php";
	        break;


	    default:
	     	
	     	tipo=id;

	     	break;
	}

	// armamos el identificador unico para el elemento con el id que es el tipo de editor de texto(html,css,javascript)
	// y el incrementador es del for. esto hace que el id sea unico para el elemento de tipo jquery y javascript
	identificador= id+incrementado;


	var myCodeMirror = CodeMirror.fromTextArea(document.getElementById(identificador),{
    	
  		mode: tipo,
  		lineNumbers: true,
  		theme: "monokai",
  		extraKeys: {
        "F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        }
        
      },
      autoCloseTags: true,

    });

}