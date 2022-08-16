<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php
            if(!isset($_SESSION['data-imprimir'])){
                echo 'Error!!!';
                exit();
              } 
              $datos_imprimir = $_SESSION['data-imprimir'];
              $dato = json_decode($datos_imprimir);
              $this->session->unset_userdata('data-imprimir');
            $usuario = $dato->usuario;
            $monto_inicial = $dato->monto_inicial;
            $fecha_apertura =$dato->fecha_apertura;
            $fecha = explode("-", $fecha_apertura);
            $ges=$fecha[0];
            $mes=$fecha[1];
            $dia=$fecha[2];
            $fecha= $dia.'/'.$mes.'/'.$ges;
            $hora_apertura = $dato->horario_apertura;
            $sucursal = $dato->sucursal;
    ?>
        <br>
        <center>
            <h3>CAPRESSO S.R.L.</h3>
        </center>
        <center>
        <font size="+2">ABRIR TURNO</font>
        </center>

        <center>
        <font size="+1"><?=$sucursal?></font>
        </center>

        <table border="1" cellpadding="2" cellspacing="1">
            <tr>
                <td width="50%" align="left"><font size="+1"><strong>Usuario:</strong></font></td>
                <td width="50%" align="left"><font size="+1"><strong><?=$usuario?></strong></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Monto inicial:</font></td>
                <td align="left"><font size="+1"><?=$monto_inicial?></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Fecha de apertura:</font></td>
                <td align="left"><font size="+1"><?=$fecha?></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Hora de apertura:</font></td>
                <td align="left"><font size="+1"><?=$hora_apertura?></font></td>
            </tr>
        </table>
        <br><br>
        <p>
            <center>
                ---------------------------------<br>
                <?=$usuario?>
            </center>
        </p>
        <hr />
    </body>
</html>

<script language="JavaScript">
window.print();
window.onafterprint = window.close;
</script>