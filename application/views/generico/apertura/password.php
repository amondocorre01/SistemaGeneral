<br>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-5">
    
        <div class="card card-outline card-danger">
            <div class="card-header">
                <center><h4>Cambiar Contraseña</h4></center>
            </div>
            <div class="card-body">
                <div style="text-align:center">
                    <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>'Capresso', 'width'=>'30%' ,'style'=>'opacity: .8'])?>
                </div>

                <br>
                <?=form_open('change-password', 'id="formCP"')?>
                <?php $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                <input type="hidden" value="<?php echo $url; ?>" name="ruta">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                       <?=form_label('Usuario', 'usuario', ['class'=>'col-form-label']);?>
                       <?=form_input(['name'=>'usuario', 'class'=>'form-control changeform', 'id'=>'usuario', 'readonly'=>'readonly','value'=>$this->session->usuario])?>
                    </div>
                </div>

               
                <label> Contraseña Actual </label>
                <div class="input-group mb-2" id="show_hide_password" >
                  <input type="password" class="form-control" required name="password-actual" id="password-actual" placeholder="Contraseña">
                  <div class="input-group-append" >
                     <div class="input-group-text" >
                     <a href="#" class="link-view-password"><span class="fa fa-eye-slash"></span></a>
                     </div>
                  </div>
               </div>

                

                <label> Nueva Contraseña </label>
                <div class="input-group mb-2" id="show_hide_password" >
                  <input type="password" class="form-control" required name="password-new" id="password-new" placeholder="Contraseña">
                  <div class="input-group-append" >
                     <div class="input-group-text" >
                     <a href="#" class="link-view-password"><span class="fa fa-eye-slash"></span></a>
                     </div>
                  </div>
               </div>
               
                <label> Repetir Contraseña </label>
                <div class="input-group mb-2" id="show_hide_password" >
                  <input type="password" class="form-control" required name="repeat-password-new" id="repeat-password-new" placeholder="Contraseña">
                  <div class="input-group-append" >
                     <div class="input-group-text" >
                     <a href="#" class="link-view-password"><span class="fa fa-eye-slash"></span></a>
                     </div>
                  </div>
               </div>

                               
                <div class="offset-md-2 col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" onclick="send()" id="registrar" class="btn btn-block btn-success btn-sm">Enviar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="reset"  class="btn btn-block btn-danger btn-sm">Cancelar</button>
                        </div>
                    </div>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script>

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


function send() {

   var actual = $('#password-actual').val();
      var newpass = $('#password-new').val();
      var newpassrepeat = $('#repeat-password-new').val();
      var user = $('#usuario').val();

      $.post("<?=site_url('change-password')?>", {actual:actual, newpass:newpass, newpassrepeat:newpassrepeat, user:user})

      .done(function( data ) {


       var res = JSON.parse( data );

       if(res.actual == false) {
      
         Swal.fire({
            icon: 'error',
            title: 'No es la contraseña actual',
            timer: 4500
         });
      }

      if(res.iguales == false) {
      
         Swal.fire({
            icon: 'error',
            title: 'las contraseñas no son iguales',
            timer: 4500
         });
      }
   });
}




</script>