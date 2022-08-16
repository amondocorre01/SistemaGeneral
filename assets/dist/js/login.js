$(document).ready(function() {
    //var data_cerrar_caja = localStorage.getItem("dataCerrarCaja");
    //console.log(data_cerrar_caja);
    let params = new URLSearchParams(location.search);
    var sms = params.get('sms');
    
    if(sms=='1'){
        var ct = JSON.stringify(params.get('ct'));
        var cts=params.get('ct');
        openPrintCierreCaja(cts);
        //var ct = params.get('ct');
        //$('#caja-ct').html(ct);
        /*
        var ctj=JSON.parse(ct);
        console.log(ctj);
        var usuario=ct['usuario'];
        console.log(usuario)
        var monto_inicial=ct['monto_inicial'];
        var fecha_apertura=ct['fecha_apertura'];
        var horario_apertura=ct['horario_apertura'];
        var monto_cierre=ct['monto_cierre'];
        var total_ingresos=ct['total_ingresos'];
        var total_egresos=ct['total_egresos'];
        var fecha_cierre=ct['fecha_cierre'];
        var hora_cierre=ct['hora_cierre'];
        $('#ctUsuario').text(usuario);
        $('#ct-montoInicial').text(monto_inicial);
        $('#ct-fechaApertura').text(fecha_apertura);
        $('#ct-horarioApertura').text(horario_apertura);
        $('#ct-montoCierre').text(monto_cierre);
        $('#ct-totalIngresos').text(total_ingresos);
        $('#ct-totalEgresos').text(total_egresos);
        $('#ct-fechaCierre').text(fecha_cierre);
        $('#ct-horaCierre').text(hora_cierre);*/
        //$("#modalImprimirCierreApertura").modal("show");
        
    }
    //console.log(sms);
    

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password span').addClass( "fa-eye-slash" );
            $('#show_hide_password span').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password span').removeClass( "fa-eye-slash" );
            $('#show_hide_password span').addClass( "fa-eye" );
        }
    });
});
