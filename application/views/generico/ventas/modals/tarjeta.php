<div class="modal fade" id="tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tarjeta de Credito/Debito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p>El pago es con tarjeta de credito o debito</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectC" name="selectDC">
                    <label class="custom-control-label" for="selectC" value="1">Tarjeta de Credito</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectD" checked="checked" name="selectDC">
                    <label class="custom-control-label" for="selectD" value="2" >Tarjeta de Debito</label>
                </div>

                <div class="row">
                    <div class="col-12" style="text-align:center">
                        <button onclick="imprimirTarjeta()" type="button" class="btn btn-app" >
                            <i class="fa fa-print"></i>Imprimir 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function imprimirTarjeta() {
        guardarPedido();
    }
</script>