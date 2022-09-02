/**LIMPIAR FORMULARIO DE REGISTRO E INGRESO */
/**Si están habilitadas entonces disparo la función: */
$(".modal.formulario").on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset(); /**Reseteamos el formulario */
})

/*=============================================
FORMATEAR LOS IPUNT
=============================================*/
$('input[name="registroEmail"]').change(function(){
	$(".alert").remove();
});
$('input[name="registroDocumento"]').change(function(){
	$(".alert").remove();
})

/**Validar el Email Repetido
 * Si el input tiene cambios ...*/
$('input[name="registroEmail"]').change(function(){
    
    var email = $(this).val();
	var datos = new FormData();
	datos.append("validarEmail", email);

    $.ajax({
        url:urlPrincipal+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
        success:function(respuesta){
            
            if(respuesta){

				var modo = respuesta["modo"];

				if(modo == "directo"){

					modo = "esta página";

				}

                /*Primero limpiamos el Input */
				$("input[name='registroEmail']").val("");
                /**Ahora, luego del Input ... */
				$("input[name='registroEmail']").after(`

				<div class="alert alert-warning">
					<strong>ERROR:</strong>
					El correo electrónico ya existe en la base de datos, fue registrado a través de `+modo+`, por favor ingrese otro diferente.
				</div>

				`);

				return;

			} /**Condicional respuesta */

        } /**Success del Ajax */

    }); /**Petición del Ajax */

}); /**Si el input del correo cambia */

/**Validar el Documento está Repetido
 * Si el input tiene cambios ...*/
 $('input[name="registroDocumento"]').change(function(){
    
    var documento = $(this).val();
	var datos = new FormData();
	datos.append("validarDocumento", documento);

    $.ajax({
        url:urlPrincipal+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
        success:function(respuesta){
            
            if(respuesta){

				var modo = respuesta["modo"];

				if(modo == "directo"){

					modo = "esta página";

				}

                /*Primero limpiamos el Input */
				$("input[name='registroDocumento']").val("");
                /**Ahora, luego del Input ... */
				$("input[name='registroDocumento']").after(`

				<div class="alert alert-warning">
					<strong>ERROR:</strong>
					El número de documento ya existe en la base de datos, fue registrado a través de `+modo+`, por favor ingrese otro diferente.
				</div>

				`);

				return;

			} /**Condicional respuesta */

        } /**Success del Ajax */

    }); /**Petición del Ajax */

}); /**Si el input del correo cambia */

$("input[name='cambiarImagen']").change(function(){
	console.log("Cargamos una imágen ...");
    let imagen = this.files[0];
    let tamaImg = imagen["size"];
    let tipoImg = imagen["type"];
    let nameImg = imagen["name"];

	console.log(imagen);
    console.log(tamaImg);
    console.log(tipoImg);
    console.log(nameImg);

    /**Solo admitiremos imágenes JPG y PNG */
    if(tipoImg != "image/jpeg" && tipoImg != "image/png"){

        $("input[name='cambiarImagen']").val("");
        $("#nombreImagenAdmins").text("Sin determinar");
        $("#tamanoImagenAdmins").text("Sin determinar");
        $("#extensImagenAdmins").text("Sin determinar");
        $("#img-foto").attr("src", ""); /**Se deja por defecto vacío */
  
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡ Solo imágenes JPG y PNG son permitidas !'
        })
            
    }else if(tamaImg > 2000000){

        $("input[name='cambiarImagen']").val("");
        $("#nombreImagenAdmins").text("Sin determinar");
        $("#tamanoImagenAdmins").text("Sin determinar");
        $("#extensImagenAdmins").text("Sin determinar");
        $("#img-foto").attr("src", ""); /**Se deja por defecto vacío */
  
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡ La imágen no puede pesar mas de 2MB !'
        })
  
    }else{
        console.log("----- PODEMOS CARGAR IMÁGEN -----");
        let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            let rutaImagen = event.target.result;
            $("#img-foto").attr("src", rutaImagen);
            $("#nombreImagenAdmins").text(nameImg);
            $("#tamanoImagenAdmins").text(tamaImg);
            $("#extensImagenAdmins").text(tipoImg);

        })

    }

})


/***************************************** */
/**TRABAJAMOS AHORA CON LA APP DE FACEBOOK */
/***************************************** */

// $(".facebook").click(function(){

// 	FB.login(function(response){

// 		console.log(response);

// 	}, {scope: 'public_profile, email'})

// })

/*=============================================
SALIR DE FACEBOOK
=============================================*/

// $(".salir").click(function(e){



// 	e.preventDefault();

// 	FB.getLoginStatus(function(response){	

// 	 	 if(response.status === 'connected'){     

// 	 	 		FB.logout(function(response){

// 	 	 			deleteCookie("fblo_2180677115313399");

// 	 	 			setTimeout(function(){

//    		 	 			window.location=urlPrincipal+"salir";

//    		 	 		},500)

// 	 	 		});

// 	 	 		function deleteCookie(name){

// 			 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
// 		 	 	}

// 	 	 }else{

// 	 	 	setTimeout(function(){

//  	 			window.location=urlPrincipal+"salir";

//  	 		},500)

// 	 	 }

// 	 })

// })