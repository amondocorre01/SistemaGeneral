<head>
    <meta charset="UTF-8">
</head>
    <div class="box">
      <div class="box-header with-border">
        <?php       
        $url= base_url('index.php/generico/inicio');
        $url= $url.'?vc='.$_GET['vc'];
        ?>
        <button id="btnExportar" class="btn btn-success derecha">
       <i class="fa fa-file-excel-o"></i> Descargar Excel
        </button> 
      </div>
      
      <div class="box-body">
        <?php if( isset($nombre_columnas) ): ?>
        <div class="card">
        <div class="card-body table-responsive p-0" style="height:100%; width:100%">
        <table id="tabla" class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <?php
                    foreach ($nombre_columnas as $item): ?>
                    <th><?=$item->column_name?></th>
                    <?php endforeach ?>
                </tr>
                </thead>
                <tbody>
                <?php
                  if ($campos_excel) {
                    foreach ($campos_excel as $item) {
                      echo '<tr>';
                        foreach ($nombre_columnas as $itemB){
                            $column=$itemB->column_name;
                            echo '<td>'.$item->$column.'</td>';
                        }
                      echo '</tr>';
                    }
                  }
                  ?>
                </tbody>
            </table>
        </div>
        </div>
        <?php endif ?>
            
      </div>
    </div>
<script>
    const $btnExportar = document.querySelector("#btnExportar"),
        $tabla = document.querySelector("#tabla");

    $btnExportar.addEventListener("click", function() {
        let tableExport = new TableExport($tabla, {
            exportButtons: false, // No queremos botones
            filename: "Reporte07", //Nombre del archivo de Excel
            sheetname: "Datos", //Título de la hoja
        });
        let datos = tableExport.getExportData();
        let preferenciasDocumento = datos.tabla.xlsx;
        tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
    });
</script>


