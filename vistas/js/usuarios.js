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