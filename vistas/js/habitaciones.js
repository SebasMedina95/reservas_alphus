/** ====================================================== 
 *  COLOCAR ACTIVE EN EL PRIMER ENLACE DE HABITACIÓN
 *  ====================================================== */
/**Capturo los enlaces de las habitaciones, accedo a la clases y voy escalando en ellas hasta
 * llegar a donde necesito */
let enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");
let tituloBoton = [];

/**Meto el limpiador de los enlaces en un método */
const limpiarEnlaces = () => {
    for (let i = 0; i < enlacesHabitaciones.length; i++) {
        
        /**Removemos la clase active para limpiar */
        $(enlacesHabitaciones[i]).removeClass("active");
        /**La etiqueta hija que esté dentro de los a la removemos */
        $(enlacesHabitaciones[i]).children("i").remove();
        /**Guardo los nombres */
        tituloBoton[i] = $(enlacesHabitaciones[i]).html();
        
    }
}

/**Ejecutamos función */
limpiarEnlaces();

/**Quitamos el último | que aparece al listar las habitaciones */
$(enlacesHabitaciones[enlacesHabitaciones.length - 1]).css({"border-right" : 0});


/**Al primer enlace como arrancamos con el le asignamos la clase active y adicionamos el html del ícono y concateno
 * el nombre para el botón para que nos quede */
$(enlacesHabitaciones[0]).addClass("active");
$(enlacesHabitaciones[0]).html("<i class='fas fa-chevron-right'></i>" + tituloBoton[0]);

/** ====================================================== 
 *  ENLACES DE HABITACIONES
 *  ====================================================== */
/**Cuando demos click en algún a */
$(".cabeceraHabitacion .dropdown .dropdown-menu a").click(function(e){  
    /**Anulamos los eventos por defecto */
    e.preventDefault();
    /**Capturamos lo que traemos en el atributo orden creado*/
    let orden = $(this).attr("orden");
    /**Capturamos lo que traemos en el atributo ruta creado */
    let ruta = $(this).attr("ruta");

    /**Limpio lo que tengamos ya por defecto */
    limpiarEnlaces();

    /**En el indice que vaya, que es el que capturamos en orden asignamos las clases */
    $(enlacesHabitaciones[orden]).addClass("active");
    $(enlacesHabitaciones[orden]).html("<i class='fas fa-chevron-right'></i>" + tituloBoton[orden]);
    
    /** ====================================================== 
     *  PETICIÓN AJAX PARA HABITACIONES
     *  ====================================================== */
    /* Tanta maroma se debe a que queremos el efecto loop en las imagenes, osea, que vuelva e inicie,
	esto puede organizarse mas fácil desde plantilla.js y desactivo esta función.
	Variable para obtener los valores del atributo del SLIDE .slideHabitaciones y sus hijos hasta llegar a li*/
	let listaSlide = $(".slideHabitaciones .slide-inner .slide-area li");
	/*Calculamos la altura del Slide para pulir el área de apación del Slider, para cuando navegue entre la botonera
	mientras quito las imagenes.*/
	let alturaSlide = $(".slideHabitaciones .slide-inner .slide-area").height();
	/*Declaro este ciclo para hacer el recorrido para que todos los indicies <li> se vacien en primera instancia
	para evitar errores, y limpiamos el html.*/
	for(let i = 0; i < listaSlide.length; i++){

		/*Pongo la imagen en la altura antes de que borre las imagenes.
        Esrto con el fin de que cuando cargamos la imagen no aparezca por un momento superpuesto el título*/
		$(".slideHabitaciones .slide-inner .slide-area").css({"height":alturaSlide+"px"})
		$(listaSlide[i]).html("");

	}

    /**Formulario de datos */
    let datos = new FormData();
    datos.append("ruta" , ruta);
    
    /**Llamamos la petición AJAX, urlPrincipal es la variable definida en plantilla.js */
    $.ajax({
        url : urlPrincipal+"ajax/habitaciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            //console.log("Respuesta: " , respuesta[orden]);
            /**GALERIA */
            let galeria = JSON.parse(respuesta[orden]["galeria"]);
			//console.log("galeria", galeria);
			/*Recorro el Array de Galeria */
			for(let i = 0; i < galeria.length; i++){		
				/*Esta acomodada es por el Plugin que estamos usando. Este orden es para poder obtener el efecto LOOP.
                El listSlide en su indice 0 coloco la ultima imagen.*/
				$(listaSlide[0]).html('<img class="img-fluid" src="'+urlServidor+galeria[galeria.length-1]+'">')
				/*En el siguiente indice coloco la imagen que debería ir normal en el recorrido
				Incrementamos en 1 para mostrar en la escala, ya uqe generamos un li adicional*/
				$(listaSlide[i+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[i]+'">')
				/*En el ultimo ítem colocamos la primera imagen, que es la que dice el indice 0
				Incremento la longitud para que me tome el ultimo li */
				$(listaSlide[galeria.length+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[0]+'">')
			}

            /**Capturo para meter el tema del video */
            $(".videoHabitaciones iframe").attr("src" , "https://www.youtube.com/embed/"+respuesta[orden]["video"]);
            /**Capturo id myPano que lo traemos de la plantilla y lo definimos en 360 GRADOS en plantilla.js */
            $("#myPano").attr("back" , urlServidor+respuesta[orden]["recorrido_virtual"]);
            /**Capturo para meter el la habitación y el estilo dentro del h1 */
            $(".descripcionHabitacion h1").html(respuesta[orden]["estilo"] + " " + respuesta[orden]["tipo"]);
            /**Capturo la clase para meter la descripción dinámicamente */
            $(".d-habitacion").html(respuesta[orden]["descripcion_h"]);
            /**Capturo el id del Dropdown para refrescar lo que nos aparece allí */
            $("#dropdown1").html(respuesta[orden]["tipo"] + " - Temática " + respuesta[orden]["estilo"]);
            /**Actualizamos el name para el formulario de consulta de disponibilidad desde categorías de habitación */
            $('input[name="id-habitacion"]').val(respuesta[orden]["id_h"]);

            /*=============================================
			TRAER TESTIMONIOS
            Vamos a traerlos en paralelo vamos mostrando las habitaciones
			=============================================*/
            var datosTestimonios = new FormData();
			datosTestimonios.append("id_h", respuesta[orden]["id_h"]);

            $.ajax({
                url:urlPrincipal+"ajax/reservas.ajax.php",
				method: "POST",
				data: datosTestimonios,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta2){
                    
                    // console.log("respuesta" , respuesta2);
                    var cantidadTestimonios = 0;
					var idTestimonios = [];
					
                    /**Primero vaciamos los testimonios */
					$(".testimonios .row").html("");
                    /**Remuevo los ver mas y menos de la estructura */
                    $(".verMasTestimonios").remove();
					$(".verMenosTestimonios").remove();
                    /**Dejo la altura auto por defecto a la maquetación */
					$(".testimonios .row").css({'height':"auto"})
                    /**Averiguamos y capturamos las reservas que estan aprobadas, pero recorremos primero */
                    for(var i = 0; i < respuesta2.length; i ++){
                        /**Si esta aprobada */
						if(respuesta2[i]["aprobado"] != 0){
                            /**Calculos */
							cantidadTestimonios++;
							idTestimonios.push(respuesta2[i]["id_testimonio"]);

						}/**Condicional */
					}/**Ciclo For */

                    /**Aplicamos la misma validación que cuando llegamos a la habitación */
                    if(cantidadTestimonios >= 4){
                        /**Vamos guardando las fotos que vamos obteniendo para que no se pierdan */
						var foto = [];
                        /**For para recorrer los aprobados */
						for(var i = 0; i < idTestimonios.length; i ++){
                            /**Si no tenemos fotos */
							if(respuesta2[i]["foto"] == ""){
                                /**Guardamos en el array la foto default */
								foto[i] = urlServidor+"vistas/img/usuarios/default/default.png";
							
							}else{
                                /**Si tenemos el modo directo de registro */
								if(respuesta2[i]["modo"] == "directo"){
                                    /**Guardamos la foto del servidor en el array */
									foto[i] = urlServidor+respuesta2[i]["foto"];

								}else{
                                    /**Guardamos la de las redes sociales */
									foto[i] = respuesta2[i]["foto"];

								}

							}
                            /**Aplicamos el div con la información, vamos agregando con el append y usamos `` para evitar
                             * truncar el proceso con las comillas*/
							$(".testimonios .row").append(`

								<div class="col-12 col-lg-3 text-center p-4">

									<img src="`+foto[i]+`" class="img-fluid rounded-circle" w-50">	
																
									<h4 class="py-4">`+respuesta2[i]["nombre"]+`</h4>

									<p>`+respuesta2[i]["testimonio"]+`</p>

								</div>

							`);
                            /**Aplicamos el redimensionamiento */
							$(".testimonios .row").css({'height':$(".testimonios .row div").height()+50+"px", 
														'overflow':'hidden'})

						}/**Ciclo for */

					}else{

                        $(".testimonios .row").html('<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>');

                    }

                    if(cantidadTestimonios > 4){

						$(".testimonios .row").after(`
							
			     				<button class="btn btn-default px-4 float-right verMasTestimonios">VER MÁS</button>
			     			
			     		`);

					}

                }
            });

        }
    
    }) //Ajax

}) //cabeceraHabitacion ul.nav li.nav-item a

/** ****************************************************************************************  */
/** BLOQUE PARA VER MAS TESTIMONIOS */
/** ****************************************************************************************  */

/**Capturamos la altura actual ... */
let alturaTestimonios = $(".testimonios .row").height();
/**Capturamos solo lo que trae la altura deld div */
let alturaTestimoniosCorta = $(".testimonios .row div").height()+50;

/**Modifico el css dando una nueva altura */
$(".testimonios .row").css({'height':alturaTestimoniosCorta+"px",
							'overflow':'hidden'});

/**Como antes hacemos una lectura de PHP, por provención, cuando se haya cargado todo ejecutamos,
 * por eso usaremos el on, lo mismo aplicaremos cuando sea el verMenosTestimonios  */
$(document).on("click", ".verMasTestimonios", function(){


    $(".testimonios .row").css({'height':alturaTestimonios+"px", 
                                'overflow':'hidden'})

    $(this).removeClass("verMasTestimonios");
    $(this).addClass("verMenosTestimonios");
    $(this).html("Ver menos");

});

$(document).on("click", ".verMenosTestimonios", function(){


	$(".testimonios .row").css({'height':alturaTestimoniosCorta+"px", 
								'overflow':'hidden'})

	$(this).removeClass("verMenosTestimonios");
	$(this).addClass("verMasTestimonios");
	$(this).html("Ver más");

});

// console.log("alturaTestimonios" , alturaTestimonios);
// console.log("alturaTestimoniosCorta" , alturaTestimoniosCorta);

