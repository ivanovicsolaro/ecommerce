function ajax_edit($url,$type,$formData,$boton)
{
	$.ajax({
        url:$url,
        type:$type,
        data:$formData,
        beforeSend: function() {
           $($boton).html('');
           $($boton).html('<i class="fa fa-spin fa-spinner"></i><span class="btn-text"> Aguarde...</span>');
           $($boton).removeClass('btn-anim');
           $($boton).addClass('opacity-7');
           $($boton).attr('disabled','disabled');
        },
        success:function(data){ 
            if(data['type'] == 'error')
            {
              swal({
                title: 'Error!',
                text: 'Intente nuevamente',
                type: 'error',
                confirmButtonText: 'Continuar'
              })
            }else{
              $('div').removeClass('has-error has-danger');

              swal({
                  title: 'Genial!',
                  text: data['msj'],
                  type: 'success',
                  showConfirmButton: false,
  				  timer: 1500
              });
            }                       
            setTimeout(function() {
                  $($boton).html('');
                  $($boton).html('<i class="fa fa-database"></i><span class="btn-text">&nbsp;Guardar</span>');                  
                  $($boton).removeClass('opacity-7');
                  $($boton).addClass('btn-anim');
                  $($boton).attr('disabled',false);;
                }, 
            100);
        },
        error: function (data) {
            var lista_errores='';
            var data = $.parseJSON(data.responseText);

            $.each(data.errors,function(index, value) {
                lista_errores+=value+"<br/>" ;
            })

            swal({
              title: 'Error!',
              html: lista_errores,
              type: 'error',
              confirmButtonText: 'Continuar'
            });

            setTimeout(function() {
                  $($boton).html('');
                  $($boton).html('<i class="fa fa-database"></i><span class="btn-text">&nbsp;Guardar</span>');                  
                  $($boton).removeClass('opacity-7');
                  $($boton).addClass('btn-anim');
                  $($boton).attr('disabled',false);;
              }, 
            100);
        }
    });
}