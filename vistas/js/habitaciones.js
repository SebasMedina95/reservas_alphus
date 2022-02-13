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
        }
    
    }) //Ajax

}) //cabeceraHabitacion ul.nav li.nav-item a

/** ****************************************************************************************  */
/** ****************************************************************************************  */
/** USANDO JS NATIVO Y, LAS VARIABLES ORDEN Y RUTA, VAMOS A INCORPORAR
 *  UN SLIDE-CARRUSEL PARA MOSTRAR LOS TIPOS DE HABITACIÓN Y QUE, NO SEA
 *  5 POR DEFECTO SI NO QUE PUEDAN SER MAS. */
/** ****************************************************************************************  */
/** ****************************************************************************************  */


