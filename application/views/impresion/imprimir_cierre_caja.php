<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cierre de Caja</title>

  <style>
    body{
        font-size: 12px;
    }

</style>
 </head>
 <body>
    <?php
        if(!isset($_SESSION['data-imprimir'])){
            echo 'Error!!!';
            exit();
          } 
          $datos_imprimir = $_SESSION['data-imprimir'];
          $res = json_decode($datos_imprimir);
          $this->session->unset_userdata('data-imprimir');
          $this->session->unset_userdata('cerrar-sesion');
          $this->session->sess_destroy();
         $usuario = $res->usuario;
         $monto_inicial = $res->monto_inicial;
         $fecha_apertura = $res->fecha_apertura;
         $fecha = explode("-", $fecha_apertura);
            $ges=$fecha[0];
            $mes=$fecha[1];
            $dia=$fecha[2];
            $fecha_apertura= $dia.'/'.$mes.'/'.$ges;
         $horario_apertura = $res->horario_apertura;
         $monto_cierre = $res->monto_cierre;
         $total_ingresos = $res->total_ingresos;
         $total_egresos = $res->total_egresos;
         $fecha_cierre = $res->fecha_cierre;
         $fecha = explode("-", $fecha_cierre);
            $ges=$fecha[0];
            $mes=$fecha[1];
            $dia=$fecha[2];
            $fecha_cierre= $dia.'/'.$mes.'/'.$ges;
         $hora_cierre = $res->hora_cierre;
         $sucursal = $res->sucursal;
         $rangoFacturas = $res->rangoFacturas;
         $cantidadRecibos = $res->cantidadRecibos;
         $totalVentasTarjetaDC = $res->totalVentasTarjetaDC;
         $direccion_dosificacion = $_SESSION['direccion_dosificacion'];
         $departamentoPais_dosificacion = $_SESSION['departamentoPais_dosificacion'];
    ?>
    <div>

        <center>
            <h2>CAPRESSO S.R.L.</h2>
        </center>
        <center>
        <font size="+1"><?=$sucursal?></font>
        </center>
        Dirección: <?=$direccion_dosificacion?>
        <?=$departamentoPais_dosificacion?> <br>
        Fecha Impresión: <?=$fecha_cierre?>
        <center>
        <font size="+1">ARQUEO DE CAJA POR TURNO</font>
        </center>
        <center>
        <table border="1" cellpadding="2" cellspacing="1">
        <tr>
            <td> <b>Usuario:</b> </td>
            <td><span id="ctUsuario"> <b><?=$usuario?></b> </span></td>
        </tr>
        <tr>
            <td>Fecha/Hora Ingreso:</td>
            <td><span id="ctUsuario"><?=$fecha_apertura?></span> <span id="ctUsuario"><?=$horario_apertura?></span></td>
        </tr>
        <tr>
            <td>Fecha/Hora Salida:</td>
            <td><span id="ctUsuario"><?=$fecha_cierre?></span> <span id="ctUsuario"><?=$hora_cierre?></span></td>
        </tr>
        <tr>
            <td>Rango Facturas:</td>
            <td><span id="ctUsuario"><?=$rangoFacturas?></span></td>
        </tr>
        <tr>
            <td>Cantidad de Recibos:</td>
            <td><span id="ctUsuario"><?=$cantidadRecibos?></span></td>
        </tr>
        <tr>
            <td>Monto Inicial:</td>
            <td><span id="ctUsuario"><?=$monto_inicial?></span></td>
        </tr>
        <tr>
            <td>Total Ingresos:</td>
            <td><span id="ctUsuario"><?=$total_ingresos?></span></td>
        </tr>
        <tr>
            <td>Total Egresos:</td>
            <td><span id="ctUsuario"><?=$total_egresos?></span></td>
        </tr>
        <tr>
            <td>Total ventas Tarj. Deb/Cred:</td>
            <td><span id="ctUsuario"><?=$totalVentasTarjetaDC?></span></td>
        </tr>
        <tr>
            <td>Monto Entregado:</td>
            <td><span id="ctUsuario"><?=$monto_cierre?></span></td>
        </tr>
        

    </table> 
    <br>
    <br>
        </center>
    
        <p>
            <center>
                ---------------------------------<br>
                <?=$usuario?>
            </center>
        </p>
        <hr />   
    </div>
 </body>
</html>
<script type="text/javascript">
window.print();
window.onafterprint = window.close;
</script>
<!--<script type="text/javascript"> window.close(); </script>-->