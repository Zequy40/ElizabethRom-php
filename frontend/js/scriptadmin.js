// JavaScript Document

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        return false;
else return true;
}

function validarusuarioalta()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsertar.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	
	$("#erroremailreal").hide("slow");
	if (!validarEmail(document.forminsertar.strEmail.value)){
		$("#erroremailreal").show("slow");
	    valid = false;
	}
	
	$("#errorpassword").hide("slow");
	if (document.forminsertar.strPassword.value == ""){
		$("#errorpassword").show("slow");
	    valid = false;
	}
	
	$("#errornombre").hide("slow");
	if (document.forminsertar.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	
	$("#errorapellidos").hide("slow");
	if (document.forminsertar.strApellidos.value == ""){
		$("#errorapellidos").show("slow");
	    valid = false;
	}
	
	return valid;
}


function validarusuarioeditar()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsertar.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	
	$("#errornombre").hide("slow");
	if (document.forminsertar.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	
	$("#errorapellidos").hide("slow");
	if (document.forminsertar.strApellidos.value == ""){
		$("#errorapellidos").show("slow");
	    valid = false;
	}
	
	return valid;
}

function validarcategoriaalta()
{
   
	
	$("#errornombre").hide("slow");
	if (document.forminsertar.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	
	$("#errororden").hide("slow");
	if (document.forminsertar.intOrden.value == ""){
		$("#errororden").show("slow");
	    valid = false;
	}
	
	return valid;
}


function validaraccesoadmin()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.formacceso.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	
	$("#erroremailreal").hide("slow");
	if (!validarEmail(document.formacceso.strEmail.value)){
		$("#erroremailreal").show("slow");
	    valid = false;
	}
	
	$("#errorpassword").hide("slow");
	if (document.formacceso.strPassword.value == ""){
		$("#errorpassword").show("slow");
	    valid = false;
	}
	
	
	
	return valid;
}

function CodificarSEO(url) {
        
  var encodedUrl = url.toString().toLowerCase(); 
  
  encodedUrl = encodedUrl.replace(/á/g, "a");
  encodedUrl = encodedUrl.replace(/é/g, "e");
  encodedUrl = encodedUrl.replace(/í/g, "i");
  encodedUrl = encodedUrl.replace(/ó/g, "o");
  encodedUrl = encodedUrl.replace(/ú/g, "u");
  encodedUrl = encodedUrl.replace(/ñ/g, "n");
  encodedUrl = encodedUrl.replace(/,/g, "-");

  encodedUrl = encodedUrl.split(/\&+/).join("-")
  encodedUrl = encodedUrl.split(/[^a-z0-9]/).join("-");       
  encodedUrl = encodedUrl.split(/-+/).join("-");
  encodedUrl = encodedUrl.trim('-'); 

	//alert (encodedUrl);
  return encodedUrl; 
}
	