/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
  datesDisabled: '0d', /**Desde el día siguiente al actual ... */
	format: 'yyyy-mm-dd',
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){

	$('.datepicker.salida').attr('readonly' , false);
  
  var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'yyyy-mm-dd'
	});

})

/*=============================================
SELECTS ANIDADOS
=============================================*/
/**Si ocurre un cambio en un select que tiene la clase selectTipoHabitacion
 * disparo una función: */

$(".selectTipoHabitacion").change(function(){
  /**Capturo el valor actual que me traiga ... */
  let ruta = $(this).val();

  if(ruta != ""){
    /**Vaciamos el tema de habitación, siempre que hay un cambio que me deje vacío*/
    $(".selectTemaHabitacion").html("");
  }else{
    $(".selectTemaHabitacion").html('<option> Temática de Habitación </option>');
  }

  
  let datos = new FormData();
  /**Recordemos que en el archivo de ajax esperamos una variable post llamada ruta 
   * dicho valor se lo asigno a un elemento que lo llamaremos también ruta */
  datos.append("ruta" , ruta); 

  $.ajax({
      url : urlPrincipal+"ajax/habitaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        
        /*Si el input de header oculto con nombre ruta, en su value traigo lo que tiene la variable respuesta en la posición 0, osea la ruta.*/
        $("input[name='ruta']").val(respuesta[0]["ruta"]);

        /**Vamos a llenar el select temático ahora con el resultado */
        for(let i = 0; i < respuesta.length; i++){
          $(".selectTemaHabitacion").append('<option value="' + respuesta[i]["id_h"] + '">' + respuesta[i]["estilo"] + '</option>');
        }
      }
  })

})

/*=============================================
CALENDARIO
=============================================*/
/**Para que no nos queden las variables Undefined si me salgo de la reserva, podemos definir
 * en el momento en que se cargue el formulario */
if($(".infoReservas").html() != undefined){
  
  var idHabitacion = $(".infoReservas").attr("idHabitacion"); /**DECLARO en VAR para poder usarla en todo el JS. */
  var fechaIngreso = $(".infoReservas").attr("fechaIngreso"); /**DECLARO en VAR para poder usarla en todo el JS. */
  var fechaSalida = $(".infoReservas").attr("fechaSalida"); /**DECLARO en VAR para poder usarla en todo el JS. */
  var dias = $(".infoReservas").attr("dias"); /**DECLARO en VAR para poder usarla en todo el JS. */

  /**Debemos guardar los eventos, es decir, todas las reservas que encontremos respecto al id
   * y/o las fechas registradas */
  let totalEventos = [];

  /**Escenarios de validación para solape de fechas */
  let opcion1 = []; /**La Fecha Ingreso del Usuario que solicita es IGUAL a la Fecha de Ingreso de alguna otra reserva. */
  let opcion2 = []; /**La Fecha Ingreso del Usuario es mayor a una Fecha de Ingreso de alguna otra reserva y al mismo tiempo la Fecha de Ingreso de Usuario es menor que la fecha de salida de la base de datos. */
  let opcion3 = []; /**3. La Fecha Ingreso del Usuario  es menor a una Fecha de Ingreso en la reservas base de datos y las Fecha de Salida al mismo tiempo si la Fecha de Salida propuesta por el usuario es superior a la Fecha de Ingreso que está registrada en la base de datos. */

  let validarDisponibilidad;

  let datos = new FormData();
  datos.append("idHabitacion" , idHabitacion);

  $.ajax({
      url : urlPrincipal+"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        
        /**La habitación está disponible */
        if(respuesta.length == 0){

          $('#calendar').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: [
              {
                start: fechaIngreso,
                end: fechaSalida,
                rendering: 'background',
                color: '#FFCC29'
              }
            ]
          
          });

          /**Apertura de la columna derecha */
          colDerReservas();

        /**Condicional ... */
        }else{

          /**Como podríamos traer varias fechas según lo que encontremos en la base de datos
           * debemos usar un ciclo para este tema.
           * 
           * Debemos guardar en un array la info para poder luego ejecutarla en la instrucción del calendario,
           * si lo ponemos ciclicamente directo en el for no nos va funcionar */
          for (let i = 0; i < respuesta.length; i++) {

            /**ESCENARIOS DE VALIDACIÓN PARA LAS FECHAS Y DISPONIBILIDAD
             * **********************************************************
             * 1. La Fecha Ingreso del Usuario que solicita es IGUAL a la Fecha de Ingreso de alguna otra reserva.
             * 2. La Fecha Ingreso del Usuario es mayor a una Fecha de Ingreso de alguna otra reserva y al mismo tiempo la Fecha de Ingreso de Usuario es menor que la fecha de salida de la base de datos.
             * 3. La Fecha Ingreso del Usuario  es menor a una Fecha de Ingreso en la reservas base de datos y las Fecha de Salida al mismo tiempo si la Fecha de Salida propuesta por el usuario es superior a la Fecha de Ingreso que está registrada en la base de datos.
             */

            /**Escenario 1. */
            if(fechaIngreso == respuesta[i]["fecha_ingreso"]){
              
              opcion1[i] = false; /**No sirve */

            }else{ 

              opcion1[i] = true; /**Si sirve */

            }

            /**Escenario 2 */
            if(fechaIngreso > respuesta[i]["fecha_ingreso"] && fechaIngreso < respuesta[i]["fecha_salida"]){
              
              opcion2[i] = false; /**No sirve */

            }else{ 

              opcion2[i] = true; /**Si sirve */

            }

            /**Escenario 3 */
            if(fechaIngreso < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){
              
              opcion3[i] = false; /**No sirve */

            }else{ 

              opcion3[i] = true; /**Si sirve */

            }

            /**Validación Total - Validar ahora la disponibilidad */
            if(opcion1[i] == false || opcion2[i] == false || opcion3[i] == false){

              validarDisponibilidad = false;

            }else{

              validarDisponibilidad = true;

            }

            /**Entonces, SI NO HAY DISPONIBILIDAD */
            if(!validarDisponibilidad){
              /**Solo pintamos las fechas que estamos obteniendo en la base de datos
               * O referencia a lo que ya tenemos en pro de la habitación.
               * Pintare de rojo lo solapado y el error generado, esto será un poco mas visual.
              */
              totalEventos.push(
                {
                  "start": fechaIngreso,
                  "end": fechaSalida,
                  "rendering": 'background',
                  "color": '#E27A7A'
                },
                {
                  "start": respuesta[i]["fecha_ingreso"],
                  "end": respuesta[i]["fecha_salida"],
                  "rendering": 'background',
                  "color": '#847059'
                }
              );
              
              $(".infoDisponibilidad").html('<h5 class="pb-5 float-left alert alert-danger">¡<b>LO SENTIMOS</b>, no hay disponibilidad para esa fecha!<br>que has registrado en los calendarios.<br><br><strong>¡Reorganiza los rangos de fechas y vuelve a intentarlo!</strong></h5>');

              /**Ahora le decimos a la columna derecha que se oculte */
              $(".colDerReservas").hide();

              break; /**Rompemos el ciclo for */

            /**SI TENEMOS DISPONIBILIDAD */
            }else{
              /**Pintamos la fecha disponible adicional a las fechas ya ocupadas */
              totalEventos.push(
                {
                  "start": respuesta[i]["fecha_ingreso"],
                  "end": respuesta[i]["fecha_salida"],
                  "rendering": 'background',
                  "color": '#847059'
                }
              );

              $(".infoDisponibilidad").html('<h4 class="pb-5 float-left alert alert-success"><b>¡El Rango de fechas está Disponible!</b></h4>');

              /**Ahora le decimos a la columna derecha que aparezca */
              /**Apertura de la columna derecha */
              colDerReservas();

            }

          } /**For */
          /**Si tenemos disponibilidad, entonces pintamos lo del usuario, luego del ciclo y luego de haber validado
           * y que nos haya quedado en verdadero. */
          if(validarDisponibilidad){
            totalEventos.push(
              {
                "start": fechaIngreso,
                "end": fechaSalida,
                "rendering": 'background',
                "color": '#FFCC29'
              }
            )
          }

          /**Validamos y mostramos los cruces de fechas */
          $('#calendar').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: totalEventos
          
          });

        }

      }/**Function Success ... */

  })/**Estructura Ajax ... */

} /**Condicional Undefined ... */

/* ************************************************** */
/** FUNCIONALIDADES DE LA COLUMNA DERECHA DE RESERVA  */
/* ************************************************** */
/**Creamos el código aleatorio */
function codigoAleatorioReserva(caracteres , longitud){

  let codigo = "";
  let codigoPre = "RES-"
  let codigoPos = "";

  for (let i = 0; i < longitud; i++) {
    
    /**Tomamos un número entero */
    rand = Math.floor(Math.random()*caracteres.length);
    /**Extraigo de los caracteres el valor que coincida en posición del aleatorio */
    codigoPos += caracteres.substr(rand , 1);
    
  }

  codigo = codigoPre + codigoPos;
  return codigo;

}

let caracteres = "0123456789ABCDEFGHIJKMNOPQRSTUVWXYZ";

function colDerReservas(){

  /**Visualizo la columna */
  $(".colDerReservas").show();

  /**Asignamos la diferencia de días */
  let def = dias + " días contados desde el " + fechaIngreso;

  console.log(def);
  $(".difDias").val(def);

  /**Creación del Código Aleatorio */
  let codigoReserva = codigoAleatorioReserva(caracteres , 11);

  /**Verificamos que no exista un código repetido, nos apoyamos de ajax */
  let datos = new FormData();
  datos.append("codigoReserva" , codigoReserva);

  $.ajax({
    url : urlPrincipal+"ajax/reservas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){

      /**Si no encontramos coincidencias, es decir, queda en false ... */
      if(!respuesta){

        $(".codigoReserva").html(codigoReserva);
        $(".pagarReserva").attr("codigoReserva",codigoReserva );

      }else{

        /**Si dado el dificil caso de que se de, entonces ...
         * Anexamos dos caracteres más para que se diferencie. */
        $(".codigoReserva").html(codigoReserva + codigoAleatorioReserva(caracteres , 2));
        $(".pagarReserva").attr("codigoReserva",codigoReserva+codigoAleatorio(caracteres, 2));

      }

      /********************************************************************** */
      /**VALIDAMOS SI EL USUARIO HIZO ALÚN CAMBIO EN EL SELECT DE LOS PLANES  */
      /********************************************************************** */
      /**Si hay un cambio en la clase elegirPlan ejecuto una función ... */
      $(".elegirPlan").change(function(){

        cambioPlanesPersonas();

      });

      /************************************************************************ */
      /**VALIDAMOS SI EL USUARIO HIZO ALÚN CAMBIO EN EL SELECT DE LAS PERSONAS  */
      /************************************************************************ */
      /**Si hay un cambio en la clase cantidadPersonas ejecuto una función ... */
      $(".cantidadPersonas").change(function(){

        cambioPlanesPersonas();

      });


    }
  })

}

/**Centralizamos el Switch para cuando cambiamos los planes o cuando cambiamos las personas, para
 * que se haga el cálculo de forma inmediata según lo seleccionado */

function cambioPlanesPersonas(){

  /**Vamos a generar un valor % según la cantidad de personas
   * Si es 1 personas, el precio del plan por la cantidad de días
   * Si es 2 personas, el precio del plan por la cantidad de días + 80% aumento con descuento
   * Si es 3 personas, el precio del plan por la cantidad de días + 80% aumento con descuento
   * Si es 4 personas, el precio del plan por la cantidad de días + 80% aumento con descuento
   * Si es 5 personas, el precio del plan por la cantidad de días + 75% aumento con descuento
   * Si es 6 personas, el precio del plan por la cantidad de días + 75% aumento con descuento
   * Si es 7 personas, el precio del plan por la cantidad de días + 75% aumento con descuento 
   * 
   * Consigna de operación para 2 personas en adelante:
   *    Se respeta el apartado anterior y:
   *        Aumento: El valor del plan se multiplica por la cantidad de días,
   *                 luego se multiplica por la cantidad de personas, 
   *                 luego multiplicamos por el % de aplicabilidad que corresponda,
   *                 sumamos nuevamente el valor del plan, y se obtienen valores de descuento.
   * **/

  /**Generamos el formato de moneda adecuado:  */
  const formatterPeso  = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
  });

  switch($(".cantidadPersonas").val()){

    case '1':

      let precioPara1Persona = $(".elegirPlan").val().split("@")[1] * dias;
      let precioConDiasFormateado1 = formatterPeso.format(precioPara1Persona);
      $(".precioReserva").html(precioConDiasFormateado1);
      console.log("Entre por el case 1 persona" , dias , precioConDiasFormateado1);

      $(".pagarReserva").attr("pagoReserva",$(".elegirPlan").val().split("@")[1] * dias)
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '2':
      /**Calculamos el aumento, lo hacemos igual a la plan por cantidad de días por el porcentaje del negocio y le sumamos el valor base */
      let aumento2 = Number($(".elegirPlan").val().split("@")[1] * dias * 1 * 0.80) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara2Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento2);
      let precioConDiasFormateado2 = formatterPeso.format(precioPara2Persona);
      $(".precioReserva").html(precioConDiasFormateado2);
      console.log("Entre por el case 2 persona" , dias , precioConDiasFormateado2);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento2));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '3':

      let aumento3 = Number($(".elegirPlan").val().split("@")[1] * dias * 2 * 0.80) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara3Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento3);
      let precioConDiasFormateado3 = formatterPeso.format(precioPara3Persona);
      $(".precioReserva").html(precioConDiasFormateado3);
      console.log("Entre por el case 3 persona" , dias , precioConDiasFormateado3);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento3));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '4':

      let aumento4 = Number($(".elegirPlan").val().split("@")[1] * dias * 3 * 0.80) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara4Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento4);
      let precioConDiasFormateado4 = formatterPeso.format(precioPara4Persona);
      $(".precioReserva").html(precioConDiasFormateado4);
      console.log("Entre por el case 4 persona" , dias , precioConDiasFormateado4);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento4));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '5':

      let aumento5 = Number($(".elegirPlan").val().split("@")[1] * dias * 4 * 0.75) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara5Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento5);
      let precioConDiasFormateado5 = formatterPeso.format(precioPara5Persona);
      $(".precioReserva").html(precioConDiasFormateado5);
      console.log("Entre por el case 5 persona" , dias , precioConDiasFormateado5);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento5));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '6':

      let aumento6 = Number($(".elegirPlan").val().split("@")[1] * dias * 5 * 0.75) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara6Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento6);
      let precioConDiasFormateado6 = formatterPeso.format(precioPara6Persona);
      $(".precioReserva").html(precioConDiasFormateado6);
      console.log("Entre por el case 6 persona" , dias , precioConDiasFormateado6);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento6));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case '7':

      let aumento7 = Number($(".elegirPlan").val().split("@")[1] * dias * 6 * 0.75) + Number($(".elegirPlan").val().split("@")[1]);
      let precioPara7Persona = Number($(".elegirPlan").val().split("@")[1] * dias + aumento7);
      let precioConDiasFormateado7 = formatterPeso.format(precioPara7Persona);
      $(".precioReserva").html(precioConDiasFormateado7);
      console.log("Entre por el case 7 persona" , dias , precioConDiasFormateado7);

      $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split("@")[1] * dias + aumento7));
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split("@")[0]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

  }

}

/*=============================================
FUNCIÓN PARA GENERAR COOKIES
=============================================*/

function crearCookie(nombre, valor, diasExpedicion){

  var hoy = new Date();
  hoy.setTime(hoy.getTime() + (diasExpedicion * 24 * 60 * 60 * 1000));
  var fechaExpedicion = "expires=" + hoy.toUTCString();
  document.cookie = nombre + "=" + valor + "; " + fechaExpedicion;

}

/*=============================================
CAPTURAR DATOS DE LA RESERVA
=============================================*/

$(".pagarReserva").click(function(){

  let idHabitacion = $(this).attr("idHabitacion");
  let imgHabitacion = $(this).attr("imgHabitacion");
  let infoHabitacion = $(this).attr("infoHabitacion")+" - "+$(this).attr("plan")+" - "+$(this).attr("personas")+" personas. La cantidad de días dispuestos para su reserva es de "+$(this).attr("dias")+ " contados desde la fecha de inicio de la reserva y entrada.";
  let pagoReserva = $(this).attr("pagoReserva");
  let codigoReserva = $(this).attr("codigoReserva");
  let fechaIngreso = $(this).attr("fechaIngreso");
  let fechaSalida = $(this).attr("fechaSalida");
  let dias = $(this).attr("dias");
  
  console.log("idHabitacion" , idHabitacion);
  console.log("imgHabitacion" , imgHabitacion);
  console.log("infoHabitacion" , infoHabitacion);
  console.log("pagoReserva" , pagoReserva);
  console.log("codigoReserva" , codigoReserva);
  console.log("fechaIngreso" , fechaIngreso);
  console.log("fechaSalida" , fechaSalida);
  console.log("dias" , dias);

  /**Nombre de la Cookie - Valor de la Cookie - Día expide */
  crearCookie("idHabitacion", idHabitacion, 1);
  crearCookie("imgHabitacion", imgHabitacion, 1);
  crearCookie("infoHabitacion", infoHabitacion, 1);
  crearCookie("pagoReserva", pagoReserva, 1);
  crearCookie("codigoReserva", codigoReserva, 1);
  crearCookie("fechaIngreso", fechaIngreso, 1);
  crearCookie("fechaSalida", fechaSalida, 1);
  crearCookie("dias", dias, 1);

})

/** *********************************************************************  */
/** ******* VAMOS A TRABAJAR EL TEMA DE MERCADO PAGO POR AQUÍ ***********  */




/*=============================================
Función Sweetalert
=============================================*/

// function fncSweetAlert(type, text, url){

//   switch (type) {

//     /*=============================================
//     Cuando ocurre un error
//     =============================================*/
//     case "error":
//       if(url == null){
//         Swal.fire({
//           icon: 'error',
//           title: 'Error',
//           text: text
//         }); 
//       }else{
//         Swal.fire({
//           icon: 'error',
//           title: 'Error',
//           text: text
//         }).then((result) => {
//           if (result.value) { 
//             window.open(url, "_top");
//           }
//         });
//       }
//     break;

//     /*=============================================
//     Cuando es correcto
//     =============================================*/
//     case "success":
//       if(url == null){
//         Swal.fire({
//           icon: 'success',
//           title: 'Success',
//           text: text
//         }); 
//       }else{
//         Swal.fire({
//           icon: 'success',
//           title: 'Success',
//           text: text
//         }).then((result) => {
//           if (result.value) { 

//             window.open(url, "_top");

//           }
//         }); 
//       }
//     break;

//     /*=============================================
//     Cuando estamos precargando
//     =============================================*/
//     case "loading":
//       Swal.fire({
//         allowOutsideClick: false,
//         icon: 'info',
//         text:text
//       });
//       Swal.showLoading()
//     break;  

//     /*=============================================
//     Cuando necesitamos cerrar la alerta suave
//     =============================================*/
//     case "close":
//       Swal.close()
//     break;

//     /*=============================================
//     Cuando solicitamos confirmación
//     =============================================*/

//     case "confirm":
//       return new Promise(resolve=>{ 
//         Swal.fire({
//           text: text,
//           icon: 'warning',
//           showCancelButton: true,
//           confirmButtonColor: '#3085d6',
//           cancelButtonColor: '#d33',
//           cancelButtonText: 'Cancel',
//           confirmButtonText: 'Yes, delete!'
//         }).then(function(result){
//           resolve(result.value);
//         })
//       })
//     break;

//     /*=============================================
//     Cuando necesitamos incorporar un HTML
//     =============================================*/
//     case "html":
//       Swal.fire({
//         allowOutsideClick: false,
//         title: 'Pago de Reserva',
//         icon: 'info',
//         html:text,
//         showConfirmButton: false,
//         showCancelButton: true,
//         cancelButtonText: 'Cancelar Pago',
//         cancelButtonColor: '#d33'
//       });
//     break;
//   } /**Cierro Swith */

// } /**Cierro función SweetAlert */

// $(".pagoConMercadoPago").click(function(e){

//   /**Anulamos los eventos por defecto */
//   e.preventDefault();

//   let DescripcionHabitacion = $(this).attr("infoHabitacion");
//   console.log("DescripcionHabitacion" , DescripcionHabitacion);

//   const mp = new MercadoPago('TEST-9b199dbd-533a-463d-bd97-35b5deab52b0');

//   const formMp = 

//     `
//     <img src="../vistas/img/payment-method/mp_logo.png" style="width:200px" class="pb-3" />

//     <div class="card bg-light mb-3">
//       <div class="card-header">Descripción del Pago: </div>
//       <div class="card-body">
//         <p class="card-text">${ DescripcionHabitacion }</p>
//       </div>
//     </div>

//     <form id="form-checkout" >

//     <div class="form-row">
//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text"><i class="far fa-credit-card"></i></span>
//             </div>
//             <input oncopy="return false" onpaste="return false" type="text" class="form-control" name="cardNumber" id="form-checkout__cardNumber" />
//           </div>
//         </div>
//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text">MM/YY</span>
//             </div>
//             <input oncopy="return false" onpaste="return false" type="text" class="form-control" name="cardExpirationDate" id="form-checkout__cardExpirationDate" />
//           </div>
//         </div>
//       </div>

//       <div class="input-group mb-3">
//         <div class="input-group-prepend">
//           <span class="input-group-text"><i class="far fa-user"></i></span>
//         </div>
//         <input oncopy="return false" onpaste="return false" type="text" class="form-control" name="cardholderName" id="form-checkout__cardholderName"/>
//       </div>

//       <div class="input-group mb-3">
//         <div class="input-group-prepend">
//           <span class="input-group-text"><i class="far fa-envelope"></i></span>
//         </div>
//         <input oncopy="return false" onpaste="return false" type="email" class="form-control" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
//       </div>


//       <div class="form-row">
//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text">CVV/CVC</span>
//             </div>
//             <input oncopy="return false" onpaste="return false" type="text" class="form-control" name="securityCode" id="form-checkout__securityCode" />
//           </div>
//         </div>

//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text"><i class="fas fa-university"></i></span>
//             </div>
//             <select class="form-control" name="issuer" id="form-checkout__issuer"></select>
//           </div>
//         </div>
//       </div>

//       <div class="form-row">
//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text"><i class="fas fa-address-card"></i></span>
//             </div>
//             <select class="form-control" name="identificationType" id="form-checkout__identificationType"></select>
//           </div>
//         </div>

//         <div class="col">
//           <div class="input-group mb-3">
//             <div class="input-group-prepend">
//               <span class="input-group-text">#</span>
//             </div>
//             <input oncopy="return false" onpaste="return false" class="form-control" type="text" name="identificationNumber" id="form-checkout__identificationNumber"/>
//           </div>
//         </div>
//       </div>

//       <div class="input-group mb-3">
//         <div class="input-group-prepend">
//           <span class="input-group-text"><i class="fas fa-list"></i></span>
//         </div>
//         <select class="form-control" name="installments" id="form-checkout__installments"></select>
//       </div>

//       <button class="btn btn-primary btn-lg btn-block" type="submit" id="form-checkout__submit"><i class="fas fa-concierge-bell"></i> Pagar la Reserva</button>

//     </form>`;

//   fncSweetAlert("html", formMp, null);

//   // Step #3
//   const cardForm = mp.cardForm({
//     amount: "1750000",
//     autoMount: true,
//     form: {
//       id: "form-checkout",
//       cardholderName: {
//         id: "form-checkout__cardholderName",
//         placeholder: "Titular de la tarjeta ...",
//       },
//       cardholderEmail: {
//         id: "form-checkout__cardholderEmail",
//         placeholder: "E-mail del Titular ...",
//       },
//       cardNumber: {
//         id: "form-checkout__cardNumber",
//         placeholder: "# Tarjeta ...",
//       },
//       cardExpirationDate: {
//         id: "form-checkout__cardExpirationDate",
//         placeholder: "Vencimiento",
//       },
//       securityCode: {
//         id: "form-checkout__securityCode",
//         placeholder: "Código ...",
//       },
//       installments: {
//         id: "form-checkout__installments",
//         placeholder: "Cantidad de Cuotas ...",
//       },
//       identificationType: {
//         id: "form-checkout__identificationType",
//         placeholder: "Tip. Documento",
//       },
//       identificationNumber: {
//         id: "form-checkout__identificationNumber",
//         placeholder: "Nro. Documento ...",
//       },
//       issuer: {
//         id: "form-checkout__issuer",
//         placeholder: "Emisor",
//       },
//     },
//     callbacks: {

//       onFormMounted: function(error){
//         if(error) return console.log("Callback Handling Error " , error);
//       },
//       onCardTokenReceived: function(error , token){
//         if(error) return console.log("Callback Handling Error " , error);
//         const formData = cardForm.getCardFormData();
//         console.log("form Data: " , formData);
//       },    
//     }

//   })

//   document.getElementById('form-checkout').addEventListener('submit', function(e){
//     e.preventDefault();
//     cardForm.createCardToken();
//   })

// })/**Función detonada con un click */



