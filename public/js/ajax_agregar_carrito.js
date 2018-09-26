function ajax_add_cart($url,$type,$formData)
{
	$.ajax({
        url:$url,
        type:$type,
        data:$formData,
        success: function(data) {
          if(data['validate'] == 1){
              swal({
                  title: 'Producto Agregado!',
                  text: 'Modal with a custom image.',
                  imageUrl: 'https://unsplash.it/400/200',
                  imageWidth: 400,
                  imageHeight: 200,
                  imageAlt: 'Custom image',
                  animation: false
                })
          }else{
              console.log('Supero el stock');
          }
        },
        error: function (data) {
          
        }
    });
}
