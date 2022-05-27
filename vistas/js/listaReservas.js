$.ajax({

    url : urlPrincipal+"ajax/datatable-listaReservas.ajax.php",
    success:function(respuesta){
        /**Si tenemos problemas con el JSON, descomentamos para ver el JSON que retorna,
         * copiamos y pegamos en un archivo de extensión JSON o JS para que nos muestre los
         * posibles errores */
        // console.log(respuesta);
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
                "sEmptyTable":     "Ningún platillo disponible en esta tabla",
                "sInfo":           "Mostrando reservas del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando reservas del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ reservas)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar Reserva en la Tabla:",
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