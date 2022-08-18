<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/ticket.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Ticket de Comprobante de Reserva</title>
</head>
<body>
    <p>Hola Mundo</p>
    <input class="idReserva" id="idReserva" type="text" value="">
    <input class="descripcionReserva" id="descripcionReserva" type="text" value="">
</body>
</html>

<!-- Obtengo el Id Reserva del Local Storage -->
<script>
    let idReservaTicket = localStorage.getItem("idReservaTicket");
    console.log("idReservaTicket" , idReservaTicket);
    document.querySelector("#idReserva").setAttribute("value" , idReservaTicket);
    /**Destruimos el elemento en el LocalStorage por seguridad */
    //localStorage.removeItem("idReservaTicket");

    /**Llamado Ajax */
    let datos = new FormData();
    datos.append("idReservaTicket" , idReservaTicket);
    let urlPrincipal = 'http://localhost/reservas-alphus/';

    $.ajax({
        url : urlPrincipal+"ajax/reservas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            console.log(respuesta);
            document.querySelector("#descripcionReserva").setAttribute("value" , respuesta[0]["descripcion_reserva"]);

        }
    });

</script>