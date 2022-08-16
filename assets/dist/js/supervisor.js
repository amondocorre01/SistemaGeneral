
function onChangeCheckbox(element){
    if(element.checked){
        const checksLlevar = document.getElementsByName("checkLlevar");
        $.each(checksLlevar, function( index, currentCheck ) {
            console.log(currentCheck);
            currentCheck.checked = true;
        });
    }else{
        console.log('desmarcar todos');
        const checksLlevar = document.getElementsByName("checkLlevar");
        $.each(checksLlevar, function( index, currentCheck ) {
            console.log(currentCheck);
            currentCheck.checked = false;
        });
    }
}

function onChangeQuantityCurrent(element){
    calcularTotales();
}

function calcularTotales(){
    
    const cantidades = document.getElementsByName("cantidades");
    const valUnitarios = document.getElementsByName("preciosUnitarios");
    const subTotales = document.getElementsByName("subtotales");
    const total = document.getElementsByName("totalCompra");
    const spanSub = $('.spanSubtotales');
    const spanTotal = $('.fullTotal');
    total[0].value = 0;
    spanTotal.text('0');

    let suma = 0;
    $.each(cantidades, function( index, cantidad ) {
        if(Number(valUnitarios[index].value) < 0){
            valUnitarios[index].value = 0;
        }
        if(Number(cantidades[index].value) < 0){
            cantidades[index].value = 1;
        }
        subTotales[index].value = (Number(valUnitarios[index].value) * Number(cantidad.value));
        spanSub[index].innerHTML=`${(Number(valUnitarios[index].value) * Number(cantidad.value))}`;
        suma = suma + (Number(valUnitarios[index].value) * Number(cantidad.value));
      });
    total[0].value = suma;
    spanTotal.text(`${suma}`);
}

function calcularRecibos(){
    const recibos = document.getElementsByName("recibos");
    const idProductosUnicos = document.getElementsByName("idProductosUnicos");
    $.each(idProductosUnicos, function( index, id_producto_unico ) {
        var listaPos= getArrayPosicionProductosUnicos(id_producto_unico.value);
        var tamListaPos = listaPos.length;
        if(tamListaPos>1){
            $.each(listaPos, function( indice, posicion ) {
                recibos[posicion].value = indice + 1;
            });
        }else{
            recibos[index].value = 1;
        }
      });
}

function getArrayPosicionProductosUnicos(id_pro_u){
    const idProductosUnicos = document.getElementsByName("idProductosUnicos");
    const listPosiciones = new Array();
    $.each(idProductosUnicos, function( index, id_producto_unico ) {
        if(id_producto_unico.value == id_pro_u){
            listPosiciones.push(index);
        }
    });
    return listPosiciones;
}

function onClickAddMessage(element){
    $('.textarea-msg').val('');
    var iden = $(element).attr("iden");
    $('.btnSaveMsg').attr("idRow",iden);
    var nameTextSms = '.sms-'+iden;
    var smsText = $(nameTextSms).val();
    if(smsText != ''){
        $('.textarea-msg').val(smsText);
    }else{

    }
}

function onClickAddCart(element,nameClase){
    var verificarClase = $(element).hasClass("btnDisable");
    var nameC = '.'+nameClase;
    if(verificarClase){
        $(element).removeClass("btnDisable");
        $(element).addClass('btn-success');
        $(nameC).val('1');
    }else{
        $(element).removeClass("btn-success");
        $(element).addClass('btnDisable');
        $(nameC).val('0');
    }
}

function deleteRows(){
    $('#tableProducts>tbody>tr').remove();
    calcularTotales();
}