<div class="modal fade" id="efectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pago en efectivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Monto Recibido en efectivo</label>
                        <input id="montoInput" oninput="calcular()" type="text" class="form-control resumen" placeholder="monto"> 
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Valor de la compra</label>
                        <input id="valorInput" type="text" class="form-control resumen" placeholder="valor"> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Cambio</label>
                        <input id="cambioInput" type="text" class="form-control resumen" placeholder="cambio"> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" style="text-align:center">
                            <button onclick="imprimirEfectivo()" type="button" class="btn btn-app">
                                <i class="fa fa-print"></i>Imprimir 
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function calcular() {

        var total =  parseInt($('#valorInput').val());
        var monto =  parseInt($('#montoInput').val());
        var cambio =  monto-total;

        $('#cambioInput').val(cambio);
    }


    function imprimirEfectivo(){
        var montoCambio =  parseInt($('#cambioInput').val());
        if(montoCambio < 0) {
            alert('No puedes realizar la impresion, el Efectivo es menor al monto a cobrar');
            $('#montoInput').val('0'); 
       }else {
            guardarPedido();
       }
    }
</script>