function ajax_add($url,$type,$formData,$boton)
{
  $('.has-danger').removeClass('has-danger');
  $('.has-error ').removeClass('has-error');
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
                text: data['msj'],
                type: 'error',
                confirmButtonText: 'Continuar'
              })
            }else{
              $('input[type!="submit"]').each(function(i, e) {
                if (e.type == 'text'){
                    e.value = '';
                }
                if (e.type == 'email'){
                    e.value = '';
                }
                if (e.type == 'number'){
                    e.value = '';
                }
              })

              $('div').removeClass('has-error has-danger');

              swal({
                  title: 'Genial!',
                  text: data['msj'],
                  type: 'success',
                  showConfirmButton: false,
            timer: 1500
              });

              $('#cargar-imagen').attr('disabled',false);
              $('#cargar-imagen').attr('href','load-images/'+data['id']);
              $("#cargar-imagen").attr('style','pointer-events: auto');
            }      

            setTimeout(function() {
                  $($boton).html('');
                  $($boton).html('<i class="fa fa-database"></i><span class="btn-text">Guardar</span>');                  
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
                  $($boton).html('<i class="fa fa-database"></i><span class="btn-text">Guardar</span>');                  
                  $($boton).removeClass('opacity-7');
                  $($boton).addClass('btn-anim');
                  $($boton).attr('disabled',false);;
              }, 
            100);
        }
    });
}