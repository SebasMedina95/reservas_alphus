$.ajax({

    url : urlPrincipal+"ajax/datatable-listaReservas.ajax.php",
    success:function(respuesta){
        /**Si tenemos problemas con el JSON, descomentamos para ver el JSON que retorna,
         * copiamos y pegamos en un archivo de extensión JSON o JS para que nos muestre los
         * posibles errores */
         //console.log(respuesta);
    }

});

$(document).ready(function() {
    $('.tablaListReservas').DataTable( {
        "ajax": urlPrincipal+"ajax/datatable-listaReservas.ajax.php",
        "pagingType": "simple_numbers",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {

                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ reservas",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ninguna reserva disponible en esta tabla",
                "sInfo":           "Mostrando reservas del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando reservas del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ reservas)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar Reserva:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "<i class='fas fa-arrow-right'></i>",
                "sPrevious": "<i class='fas fa-arrow-left'></i>"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

        },
        "lengthMenu": [3, 5, 10, 15, 20, 50, 100],
        "pageLength": 3
    });
});

/*************************************************************** */
/********************* VISUALIZAR TESTIMONIO ******************* */
/**Tenemos un detalle acá, si lo hacemos de la manera tradicional, no nos va traer nada el console, por que
 * en el momento que cargamos la información, no se nos ha terminado de renderizar el formulario, esto por que
 * JS carga todo en tiempo real, el Ajax lo hace después, por lo que deberíamos de dar una espera, por tanto, lo que haremos es que
 * a la clase de la tabla, al terminar de cargar, con el ON aplicaremos por medio de la función clic, buscar
 * la clase visualizarTestimonio que está dentro de un botón button y allí ejecutamos la función.
 */
$(".tablaListReservas tbody").on("click", "button.visualizarTestimonio", function(){

    let testimonio = $(this).attr("valTestimonio");
    //console.log("testimonio" , testimonio);

    /**Realizamos la asignación al atributo de HTML */
    $("#soloVerTestimonio").val(testimonio);
    $("#soloVerTestimonio").html(testimonio);

});

/*************************************************************** */
/********************* ACTUALIZAR TESTIMONIO ******************* */
$(".tablaListReservas tbody").on("click", "button.editarTestimonio", function(){

    let idTestimonio = $(this).attr("idTestimonioEdit");
    let testimonioEdit = $(this).attr("editarTestimonio");
    // console.log("idTestimonio" , idTestimonio);
    // console.log("testimonioEdit" , testimonioEdit);
    /**Realizamos la asignación al atributo de HTML */
    $("#editarIdTestimonio").val(idTestimonio);
    $("#editarIdTestimonio").html(idTestimonio);

    $("#editarTestimonio").val(testimonioEdit);
    $("#editarTestimonio").html(testimonioEdit);

});

/******************************************************************* */
/********************* VAMOS A GENERAR EL TICKET ******************* */
$(".tablaListReservas tbody").on("click", "button.generarTicket", function(e){

    /**Anulemos la opción por defecto */
    e.preventDefault();
    
    let idReservaTicket = $(this).attr("idReservaGenerarTicket");
    console.log("idReserva" , idReservaTicket);
    console.log(urlPrincipal);

    /**Guardo en el LocalStorage el id de reserva y luego lo tomo en el .php
     * del ticket, una vez tomado elimino el elemento del localStorage para no
     * comprometer la seguridad */
     localStorage.setItem("idReservaTicket", idReservaTicket);
    /**Abro ventana nueva para el ticket */
    window.open(urlPrincipal+"vistas/paginas/modulos/ticketComprobante.php");


    /**Haremos esto mediante Cookies, vivirá 1 solo día */
    // let nombre = "idReservaTicket"; 
    // let valor = idReservaTicket; 
    // let diasExpedicion = 1;

    // var hoy = new Date();
    // hoy.setTime(hoy.getTime() + (diasExpedicion * 24 * 60 * 60 * 1000));
    // var fechaExpedicion = "expires=" + hoy.toUTCString();
    // document.cookie = nombre + "=" + valor + "; " + fechaExpedicion;

});


// $(document).ready(function() {
//     $('.tablaListReservasV2').DataTable( {
//         "pagingType": "simple_numbers",
//         "deferRender": true,
//         "retrieve": true,
//         "processing": true,
//         "language": {

//                 "sProcessing":     "Procesando...",
//                 "sLengthMenu":     "Mostrar _MENU_ reservas",
//                 "sZeroRecords":    "No se encontraron resultados",
//                 "sEmptyTable":     "Aún no se han registrado reservas en esta tabla",
//                 "sInfo":           "Mostrando reservas del _START_ al _END_ de un total de _TOTAL_",
//                 "sInfoEmpty":      "Mostrando reservas del 0 al 0 de un total de 0",
//                 "sInfoFiltered":   "(filtrado de un total de _MAX_ reservas)",
//                 "sInfoPostFix":    "",
//                 "sSearch":         "Buscar Reserva en la Tabla:",
//                 "sUrl":            "",
//                 "sInfoThousands":  ",",
//                 "sLoadingRecords": "Cargando...",
//                 "oPaginate": {
//                 "sFirst":    "Primero",
//                 "sLast":     "Último",
//                 "sNext":     "<i class='fas fa-arrow-right'></i>",
//                 "sPrevious": "<i class='fas fa-arrow-left'></i>"
//                 },
//                 "oAria": {
//                     "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//                 }

//         },
//         "lengthMenu": [3, 5, 10, 15, 20, 50, 100],
//         "pageLength": 3
//     });
// });