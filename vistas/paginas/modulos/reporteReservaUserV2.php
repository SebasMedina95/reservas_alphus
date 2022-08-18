<?php

//require "../../librerias/FDPF/fpdf.php";
require "../../librerias/FDPF/PDF_MC_Table.php";

/**PLANTILLA Y RUTA */
require_once "../../../controladores/plantilla.controlador.php";
require_once "../../../controladores/ruta.controlador.php";

/**RESERVAS DE HABITACIÓN */
require_once "../../../controladores/reservas.controlador.php";
require_once "../../../modelos/reservas.modelo.php";

/**USUARIO DE LA RESERVA */
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();
session_start(); /**Para manejar variables de sesión ... */

/******************  DESDE ACA VAMOS A TOMAR LOS ESTILOPS, LO HAREMOS POR ESTE LADO POR AHORA  ******************/
$usuarioListReservas  = $_SESSION["id"];
$reservasListReservas = ControladorReservas::ctrMostrarReservasUsuario($usuarioListReservas);
$usuariosReservas = ControladorUsuarios::ctrMostrarUsuario("id_u" , $usuarioListReservas);
$servidorListReservas = ControladorRuta::ctrServidor();	
$time = date("Y-m-d");
/**____________________________________________________________________________________________________________ */

$pdf=new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->Cell(40,6, utf8_decode('Reporte de Reservas.') ,0,0,'C');
$pdf->Line(38, 16, 195, 16);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->Cell(14,6,  utf8_decode('Usuario: ') ,0,0, 'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(28,6,  utf8_decode($usuariosReservas["nombre"]) ,0,0, 'L');
//
$pdf->SetFont('Arial','B',10);
$pdf->Cell(90,6,  utf8_decode('Nro. Documento: ') ,0,0, 'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(90,6,  utf8_decode($usuariosReservas["numero_documento"]) ,0,0, 'L');
//
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->Cell(14,6,  utf8_decode('Reporte: ') ,0,0, 'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(28,6,  utf8_decode('Listado de reservas realizadas por el usuario.') ,0,0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->Cell(14,6,  utf8_decode('Fecha: ') ,0,0, 'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(28,6,  utf8_decode($time) ,0,0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,'',0,0,'C');
$pdf->Cell(14,6,  utf8_decode('Email: ') ,0,0, 'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(28,6,  $usuariosReservas["email"] ,0,0, 'L');
$pdf->Ln();
$pdf->Line(38, 48, 195, 48);
/**--------------------------------------------------------------------------- */
$pdf->Image('../../../vistas/img/iconoAlphus.png' , 8, 8, 27, 27, 'png');
/**--------------------------------------------------------------------------- */


$pdf->Ln(10);

$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(38, 6, utf8_decode('IMÁGEN'),  1,0, 'C', 1); 
$pdf->Cell(22, 6, utf8_decode('CÓDIGO'),  1,0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('FECHAS'),  1,0, 'C', 1);
$pdf->Cell(60, 6, utf8_decode('RESERVA'), 1,0, 'C', 1);
$pdf->Cell(23,6,'VALOR',1,0,'C',1);
$pdf->Cell(22,6,'MED. PAGO',1,0,'C',1);
$pdf->SetFont('Helvetica','',9);

$pdf->Ln(10);

//$objetoPdf = new PDF_MC_Table();

$pdf->SetWidths(array(38, 22, 25, 60, 23, 22));

$contador = 0;


foreach ($reservasListReservas as $key => $value) {

    $valorReserva = "$ ".number_format($value["pago_reserva"], 0, ',', '.');
    $fechaInicioFormateada = date_create_from_format("Y-m-d", $value["fecha_ingreso"])->format("d-M-Y");
    $fechaFinFormateada = date_create_from_format("Y-m-d", $value["fecha_salida"])->format("d-M-Y");

    $testimonio = ControladorReservas::ctrMostrarTestimonios("id_reserva_t" , $value["id_reserva"]);

    // $pdf->Row(array(utf8_decode($nombre),utf8_decode($categoria),$codigo,$stock,utf8_decode($descripcion)));
    $pdf->Row(
        array(
            $pdf->Cell($pdf->GetX()-10, 0, $pdf->Image(''.$servidorListReservas.$value["img"].'' , $pdf->GetX()+3, $pdf->GetY()+2,0, 22)) , 
            $value["codigo_reserva"], 
            'Desde: ' . $fechaInicioFormateada . '  Hasta: ' . $fechaFinFormateada,
            utf8_decode($value["descripcion_reserva"]), 
            $valorReserva,
            $value["pasarela_pago"]
        )
    );

    if($contador == 6){
        $pdf->AddPage();
        $contador = 0;
    }else{
        $contador ++;
    }
    
    // $pdf->Row(
    //     array(
    //         $pdf->Cell(58,6, $pdf->Image(''.$servidorListReservas.$value["img_min"].'' , $pdf->GetX(), $pdf->GetY(),0, 45) , 1, 'C'),
    //         $pdf->Cell(50,6, $value["codigo_reserva"]),
    //         $pdf->Cell(30,6, $value["descripcion_reserva"]),
    //         $pdf->Cell(12,6, $valorReserva),
    //         $pdf->Cell(35,6, $testimonio[0]["testimonio"])
    //     )
    // );
    
    
}

$pdf->Output();


?>