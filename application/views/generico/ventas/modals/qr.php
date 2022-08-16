<div class="modal fade" id="qr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">

            <p>Verifico el estado de pago correcto en el sistema SIP</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectNO" name="selectSINO">
                    <label class="custom-control-label" for="selectNO" value="0">No</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="selectSI" checked="checked" name="selectSINO">
                    <label class="custom-control-label" for="selectSI" value="1" >Si</label>
                </div>

                <div class="row">
                    <div class="col-12" style="text-align:center">
                        <button onclick="imprimirQR()" type="button" class="btn btn-app" >
                            <i class="fa fa-print"></i>Imprimir 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     function imprimirQR() {
        var value = $('input:radio[name=selectSINO]').val();
        if(document.getElementById('selectNO').checked){
            alert('No puede imprimir');
        }else{
            guardarPedido();
        }
    }
</script>