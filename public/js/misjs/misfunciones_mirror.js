function declararelementosmirrorThtml(my_mimetype,id){


	var myCodeMirror = CodeMirror.fromTextArea(document.getElementById(id),{
    	
  		mode: my_mimetype,
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