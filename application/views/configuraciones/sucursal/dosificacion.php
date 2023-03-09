<div id="tab-<?=$id?>"> 

        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-<?=$codigo?>">

          <ul>
              <li><a href="#opcion-2-<?=$codigo?><?=$id?>"> Impresión </a></li>
              <li><a href="#opcion-4-<?=$codigo?><?=$id?>"> Mensajes </a></li>
              <li><a href="#opcion-5-<?=$codigo?><?=$id?>"> Impresora </a></li>
          </ul>
    
         
          <div id="opcion-2-<?=$codigo.$id?>">
             <!--<?=$this->load->view('configuraciones/sucursal/impresion', null, TRUE);?> -->
          </div>
         

		  <div id="opcion-4-<?=$codigo.$id?>">

         <?=$this->load->view('configuraciones/sucursal/mensaje', null, TRUE);?> 
         </div>


          <div id="opcion-5-<?=$codigo.$id?>"> 
			 	<!--<?=$this->load->view('configuraciones/sucursal/impresora', null, TRUE);?> -->
          </div>
      </div>
</div>

      <script>

        $('#opciones-<?=$codigo?>').responsiveTabs({
            startCollapsed: 'accordion'
        });

        var show_update = 0;

	 
      </script>