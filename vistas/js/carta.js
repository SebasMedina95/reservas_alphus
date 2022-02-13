/**CUADRICULA O LISTA */
let btnList = $(".btnMostrarList");


$("#btnGrid0").click(function(){
    /**Ocultamos el estilo de lista */
    $(".list0").hide();
    /**Mostramso el estilo de Grid */
    $(".grid0").show();

    $("#btnGrid0").addClass("btn-secondary");
    $("#btnList0").removeClass("btn-secondary");

});

$("#btnList0").click(function(){
    /**Mostramos el estilo de list */
    $(".list0").show();
    /**Ocultamos el estilo Grid */
    $(".grid0").hide();

    $("#btnGrid0").removeClass("btn-secondary");
    $("#btnList0").addClass("btn-secondary");

});

/****************************************************************** */
/**MANEJAREMOS EL TEMA DE LOS DATATABLES PARA PRESENTAR INFORMACIÓN */
/****************************************************************** */



/**CARGAMOS DE FORMA DINÁMICA LA CARTA DE PRODUCTOS */

$.ajax({

    url : urlPrincipal+"ajax/datatable-carta.ajax.php",
    success:function(respuesta){
        /**Si tenemos problemas con el JSON, descomentamos para ver el JSON que retorna,
         * copiamos y pegamos en un archivo de extensión JSON o JS para que nos muestre los
         * posibles errores */
        // console.log(respuesta);
    }

});


$(document).ready(function() {
    $('.tablaCarta').DataTable( {
        "ajax": urlPrincipal+"ajax/datatable-carta.ajax.php",
        "pagingType": "simple_numbers",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {

                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ platillos",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún platillo disponible en esta tabla",
                "sInfo":           "Mostrando platillos del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando platillos del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ platillos)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar Platillo en la Tabla:",
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
        "lengthMenu": [5, 10, 15, 20, 50, 100],
        "pageLength": 5
    });
});


