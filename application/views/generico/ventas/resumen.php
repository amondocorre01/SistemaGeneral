<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Resumen</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="">NIT</label>
                        <div class="input-group input-group-xs">
                            <input id="inputSearchNit" type="text" class="form-control form-control-xs resumen" placeholder="Ingrese NIT o C.I.">
                            <div class="input-group-append">
                                <button class="btn btn-md btn-default" id="searchNit" onclick="searchCliente()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div> 
                    </div>

                    <div class="mb-3 col-8">
                        <label for="">Cliente</label>
                        <input id="clienteInput" type="text" class="form-control resumen" placeholder="Cliente"> 
                    </div>

                    <div class="mb-3 col-4">
                        <label for="">Total</label>
                        <input type="text" id="totales" class="form-control resumen"  placeholder="Total"> 
                    </div>

                    <div class="mb-3 col-4">
                        <label for="">Efectivo</label>
                        <input type="text" class="form-control resumen" placeholder="Efectivo"> 
                    </div>

                    <div class="mb-3 col-4">
                        <label for="">Cambio</label>
                        <input type="text" class="form-control resumen" placeholder="Cambio"> 
                    </div>
                </div>

                
                <div class="row">
                    <div class="mb-6 col-8">
                        <input type="hidden" id="metodo" value="1" >
                        <a class="btn btn-app btn-pago bg-danger" onclick="metodoPago(1, this)" >
                            <i class="fa fa-money"></i> Efectivo
                        </a>

                        <a class="btn btn-app btn-pago" onclick="metodoPago(2, this)">
                            <i class="fa fa-credit-card"></i> Tarjeta
                        </a>

                        <a class="btn btn-app btn-pago" onclick="metodoPago(3, this)">
                            <i class="fa fa-bank"></i> T. Bancaria
                        </a>

                        <a class="btn btn-app btn-pago" onclick="metodoPago(4, this)">
                            <i class="fa fa-qrcode"></i> QR
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-6 col-6">
                        <a class="btn btn-app" onclick="imprimirFactura()">
                            <i class="fa fa-print"></i> Imprimir
                        </a>

                        <a class="btn btn-app" onclick="salir()">
                            <i class="fa fa-window-close"></i> Cerrar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
