<?php

if(isset($_SESSION["validarSesion"])){

    if($_SESSION["validarSesion"] == "ok"){
        
        include "modulos/banner-interior.php";
        include "modulos/info-perfil.php";
        include "modulos/habitaciones.php";
        include "modulos/planes.php";
        include "modulos/planes-movil.php";
        include "modulos/recorrido-pueblo.php";
        //include "modulos/contactenos-hotel.php";
        echo '<div class="mb-8"></div>';

    }else{

        echo '<script>
            window.location = "'.$ruta.'";
        </script>';
    
    }

}else{

    echo '<script>
        window.location = "'.$ruta.'";
    </script>';

}

