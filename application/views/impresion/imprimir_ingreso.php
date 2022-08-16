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
          $res = json_decode($datos_imprimir);
          $this->session->unset_userdata('data-imprimir');
            $usuario = $res->usuario;
            $monto = $res->monto;
            $descripcion = $res->descripcion;
            $descripcionIE = $res->descripcionIE;
            $fecha = $res->fecha;
            $hora = $res->hora;
            $sucursal = $res->sucursal;
        ?>
        <br>
        <center>
            <h3>CAPRESSO S.R.L.</h3>
        </center>
        <center>
        <font size="+2">INGRESO</font>
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
                <td align="left"><font size="+1">Detalle de Movimiento:</font></td>
                <td align="left"><font size="+1"><?=$descripcionIE?></font></td>
            </tr>
            <tr>
                <td align="left"><font size="+1">Monto:</font></td>
                <td align="left"><font size="+1"><?=$monto?></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Descripcion:</font></td>
                <td align="left"><font size="+1"><?=$descripcion?></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Fecha:</font></td>
                <td align="left"><font size="+1"><?=$fecha?></font></td>
            </tr>

            <tr>
                <td align="left"><font size="+1">Hora:</font></td>
                <td align="left"><font size="+1"><?=$hora?></font></td>
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

<script type="text/javascript">
window.print();
window.onafterprint = window.close;
</script>