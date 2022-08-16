<div class="modal fade" id="transferencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transferencia Bancaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p>Quien autorizo y verifico que el dinero ingresara a la cuenta?</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectRMA" name="selecTrans">
                    <label class="custom-control-label" for="selectRMA" value="1" >Ronald Mendez</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectDSM" checked="checked" name="selecTrans">
                    <label class="custom-control-label" for="selectDSM" value="2" >Daniel Saavedra</label>
                </div>

                <div class="row">
                    <div class="col-12" style="text-align:center">
                            <button onclick="imprimirTransferencia()" type="button" class="btn btn-app" >
                                <i class="fa fa-print"></i>Imprimir 
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function imprimirTransferencia() {
        guardarPedido();
    }
</script>