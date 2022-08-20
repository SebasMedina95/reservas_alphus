<?php
//Activamos el almacenamiento en el buffer
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../css/ticket.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../../img/iconoAlphus.png">

    <script defer src="../../librerias/JsBarcode/JsBarcode.all.min.js"></script>
    <script defer src="../../librerias/QrCode/qrcode.min.js"></script>
    <script defer src="../../librerias/qrious/qrious.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Ticket de Comprobante de Reserva</title>
</head>
<body>
    <!-- <p>Hola Mundo</p>
    <input class="idReserva" id="idReserva" type="text" value="">
    <input class="descripcionReserva" id="descripcionReserva" type="text" value="">
    <input class="hola" id="hola" type="text" value=""> -->

    <!-- /**Creamos un segundo contenedor para que nos tome todos los estilos del div zona_impresion */ -->
    <div class="zona_impresion2" id="zona_impresion2">
        <div class="zona_impresion" id="zona_impresion">
            <!-- codigo imprimir -->
            <br>
            <table border="0" align="center" width="300px">
                <tr>
                    <td align="center">
                        <img class="logoHotel" id="logoHotel" src="../../img/alphus_complete_banner.png" alt="Hotel Alphus" width="100%"><br> 
                    </td> 
                </tr>
                <tr>
                    <td align="center">
                        <span align="center"><b>.:: Comprobante de Reserva ::.</b></span>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <span align="center">.:: Código de Reserva para Comprobante ::.</span>
                        <br>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="3">==========================================</td>
                </tr>
                <tr>
                    <td align="center">
                        <h2><font color="#82684e"><span align="center" class="codigoReserva" id="codigoReserva">Valor</font></span></h2>
                    </td>
                </tr> -->
                <!-- <tr>
                    <td colspan="3">==========================================</td>
                </tr> -->
                <tr>
                    <td align="center"><b>Fec. Reserva:</b> <span align="left" class="fechaCliente" id="fechaCliente">Valor</span></td>
                </tr>
                <tr>
                <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
                <tr>
                    <!-- Mostramos los datos del cliente en el documento HTML -->
                    <td><b>Doc. Cliente:</b> <span align="left" class="documentoCliente" id="documentoCliente">Valor</span></td>
                </tr>
                <tr>
                    <td><b>Cliente:</b> <span align="left" class="nombreCliente" id="nombreCliente">Valor</span></td>
                </tr>
                <tr>
                    <td><b>Celular:</b> <span align="left" class="celularCliente" id="celularCliente">Valor</span></td>
                </tr>
                <tr>
                    <td><b>Email:</b> <span align="left" class="emailCliente" id="emailCliente">Valor</span></td>
                </tr>
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
            </table>
                
            <table class="tablita" style="margin-top: -50px;" align="center" border="0" width="300px">
                <tr>
                    <td style="background-color: #F0F0F0;" width="100%" align="center"><span align="center"><b>INFORMACIÓN DE LA RESERVA: </b></span></td>
                </tr>
                <tr>
                    <td align="center" colspan="3"><img class="imagen" id="imagen" src="" alt="Hotel Alphus" width="80%"></td>
                </tr>
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><span class="descripcionReserva" id="descripcionReserva">Valor</span></td>
                </tr>
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
                <tr>
                    <td align="right"><b>Código Reserva:</b><span class="codigoReserva" id="codigoReserva">Valor</span></td>
                </tr>
                <tr>
                    <td align="right"><b>Fechas: </b> Desde: <span class="fechaIngresoReserva" id="fechaIngresoReserva">Valor</span> Hasta <span class="fechaSalidaReserva" id="fechaSalidaReserva"></td>
                </tr>
                <!-- <tr>
                    <td align="right"><b>Fecha de Salida:</b><span class="fechaSalidaReserva" id="fechaSalidaReserva">Valor</span></td>
                </tr> -->
                <!-- <tr>
                    <td align="right"><b>Cantidad de días:</b><span class="cantDiasReserva" id="cantDiasReserva">Valor</span></td>
                </tr> -->
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
                <tr>
                    <td style="background-color: #F0F0F0;" align="right"><b>TOTAL RESERVA:</b><span class="totalReserva" id="totalReserva">Valor</span></td>
                </tr>
                <tr>
                    <td colspan="3">==========================================</td>
                    <br>
                </tr>
                <tr align="center">
                    <td colspan="3" align="center">¡Gracias por su reserva!</td>
                    <br>
                </tr>
                <tr align="center">
                    <td colspan="3" align="center">Lo estaremos esperando</td>
                    <br>
                </tr>
                <tr align="center">
                    <td colspan="3" align="center">Puede escanear el siguiente QR para mas información</td>
                    <br>
                </tr>
                <tr>
                    <td class="tdContenedor" align="center">
                        <!-- <img id="barcode" width="100%"></img> -->
                        <!-- <div class="contenedorQr" id="contenedorQr"></div> -->
                        <img src="" class="qr" id="qr"></img>
                    </td>
                </tr>
                <!-- <tr align="center">
                    <td colspan="3" align="center"><img class="logoHotelMin" id="logoHotelMin" src="../../img/iconoAlphus.png" alt="Hotel Alphus" width="20%"></td>
                    <br>
                </tr> -->
                <tr>
                    <td colspan="3">==========================================</td>
                </tr>
            </table>

            </table>
            <br>
        </div>
    </div>

    

</body>

<!-- <div class="container">
        <div class="row">
            <table>
                <button type="button" onclick="imprSelec()">Imprimir Comprobante</button>
            </table>
        </div>
    </div> -->

</html>

<!-- Obtengo el Id Reserva del Local Storage -->
<script>
    let idReservaTicket = localStorage.getItem("idReservaTicket");
    console.log("idReservaTicket" , idReservaTicket);
    //document.querySelector("#idReserva").setAttribute("value" , idReservaTicket);
    /**Destruimos el elemento en el LocalStorage por seguridad */
    //localStorage.removeItem("idReservaTicket");

    /**Llamado Ajax */
    let datos = new FormData();
    datos.append("idReservaTicket" , idReservaTicket);
    let urlPrincipal = 'http://reservas-alphus.com/';
    let urlServidor  = 'http://reservas-alphus.com/administracion/';

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

            //descripcionReserva = respuesta[0]["descripcion_reserva"];
            //imagen = urlServidor+respuesta[0]["img"];
            //codigoReserva = respuesta[0]["codigo_reserva"];
            //codigoReserva = respuesta[0]["codigo_reserva"];

            //document.querySelector("#descripcionReserva").setAttribute("value" , descripcionReserva);  fechaIngresoReserva  fechaSalidaReserva
            document.querySelector(".zona_impresion #documentoCliente").innerHTML=respuesta[0]["numero_documento"];
            document.querySelector(".zona_impresion #nombreCliente").innerHTML=respuesta[0]["nombre"];
            document.querySelector(".zona_impresion #celularCliente").innerHTML=respuesta[0]["celular"];
            document.querySelector(".zona_impresion #fechaCliente").innerHTML=respuesta[0]["fecha"];
            document.querySelector(".zona_impresion #emailCliente").innerHTML=respuesta[0]["email"];
            document.querySelector(".zona_impresion #descripcionReserva").innerHTML=respuesta[0]["descripcion_reserva"];
            document.querySelector(".zona_impresion #codigoReserva").innerHTML=' '+respuesta[0]["codigo_reserva"];
            document.querySelector(".zona_impresion #fechaIngresoReserva").innerHTML=' '+respuesta[0]["fecha_ingreso"];
            document.querySelector(".zona_impresion #fechaSalidaReserva").innerHTML=' '+respuesta[0]["fecha_salida"];
            // document.querySelector(".zona_impresion #cantDiasReserva").innerHTML=' '+respuesta[0]["dias"];

            /**Para la imágen decodifico primero para tener el valor de la galería */
            let galeria = JSON.parse(respuesta[0]["galeria"]);
            let galeriaImagen = galeria[0];
            // console.log("galeriaImagen" , galeriaImagen);

            document.querySelector(".zona_impresion #imagen").setAttribute('src' , urlServidor+galeriaImagen);

            let valReserva = parseFloat(respuesta[0]["pago_reserva"]);
            const formateado = valReserva.toLocaleString("es", {
                style: "currency",
                currency: "COP"
            });

            document.querySelector(".zona_impresion #totalReserva").innerHTML='$ '+formateado;

            // JsBarcode("#barcode", respuesta[0]["codigo_reserva"]);
            // const contenedorQr = document.getElementById('contenedorQr');
            // const elementosQr = 'Código de Reserva' + respuesta[0]["codigo_reserva"] + ' - Descripciones: ' + respuesta[0]["descripcion_reserva"];
            // new QRCode(contenedorQr , {
            //     text   : elementosQr,
            //     width  : 150,
            //     height : 150,
            //     colorDark  : "#000000",
            //     colorLight : "#ffffff"
            // });
            let elementosQr = '*** Código de Reserva: ' + respuesta[0]["codigo_reserva"] + ' *** Descripciones: ' + respuesta[0]["descripcion_reserva"] + ' *** Fechas: Desde el ' + respuesta[0]["fecha_ingreso"] + ' hasta el ' + respuesta[0]["fecha_salida"] + ' *** Cliente: ' + respuesta[0]["nombre"] + ' identificado con número de documento: ' + respuesta[0]["numero_documento"];


            let qr = new QRious({
                background: "white",
                level: 'L',
                size: 150,
                element: document.querySelector('#qr'),
                value: elementosQr
            });
                


        }

    });

    function imprSelec() {
        // var ficha = document.getElementById('zona_impresion');
        // var ventimp = window.open(' ', 'popimpr, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=340px, height=600px');
        // ventimp.document.write( ficha.innerHTML );
        // ventimp.document.close();
        // ventimp.print( );
        // ventimp.close();
        var contenido = document.getElementById('zona_impresion2').innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
	}

    setTimeout(function(){
        window.onload = imprSelec();
    }, 1000);


    // $(document).ready(function(){
    //     $('#getUser').on('click',function(){
    //         var userID = $('#userSelect').val();
    //         $('#userInfo').load('getData.php?id='+userID,function(){
    //             var printContent = document.getElementById('userInfo');
    //             var WinPrint = window.open('', '', 'width=900,height=650');
    //             WinPrint.document.write(printContent.innerHTML);
    //             WinPrint.document.close();
    //             WinPrint.focus();
    //             WinPrint.print();
    //             WinPrint.close();
    //         });
    //     });
    // });

</script>

<?php 

ob_end_flush();

?>

