@extends('layouts.app') @section('contenido')

@section('css')
    <link rel="stylesheet" href="{{asset('libs/dropzone/dist/dropzone.css')}}">
@stop

@section('title')
    Cargar Imagen Producto
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">

                    {!! Form::open(['route'=> ['upload.images',$producto->id], 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                    <div class="dz-message" style="height:200px;">
                        Drop your files here
                    </div>
                    <div class="dropzone-previews"></div>
                    <input type="hidden" name="idProducto" value="{{$producto->id}}">
                    {!! Form::close() !!}
                </div>
                <div class="text-right col-md-12">
                    <a href="{!! route('productos.index') !!}" class="primary-btn btn-success btn-anim">
                       <span class="btn-text"> Finalizar</span>
                    </a>
                </div>
                </div>

         
            </div>
        </div>
    </section>


@endsection

@section('js')
    @parent 
<script src="{{asset('libs/dropzone/dist/dropzone.js')}}"></script>
 <script> 
        Dropzone.options.myDropzone = {
            autoProcessQueue: true,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            
            init: function(){
                myDropzone = this;
                myDropzone.processQueue();
                url = '{{asset('productos/server-images/'.$producto->id)}}';
                urlArchivos = '{{asset('img/products/'.$producto->id).'/thumbnails/'}}';

                $.get(url, function(data) {

                    $.each(data, function(key,value){                        
                        $.each(data.images,function(index, value) {
                            var mockFile = { name: value.name, size: value.size };
                            myDropzone.options.addedfile.call(myDropzone, mockFile);
                            myDropzone.options.thumbnail.call(myDropzone, mockFile, urlArchivos+value.name);
                        });
                    });
                });
            
             
                this.on("addedfile", function(file) {
                  
                });
                
                this.on("complete", function(file) {
                    myDropzone.removefile(file);
                });
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );                
            },

            removedfile: function(file) {
                var name = file.name;  
                var token = $('[name=_token').val();

                console.log(file.name);      
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-Token': token},
                    url: '{{route('remove.images', $producto->id)}}',
                    data: {id: {{$producto->id}}, name: name},
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                availableImages = availableImages + 1;
            }


        };



    </script>
   

  
@endsection 