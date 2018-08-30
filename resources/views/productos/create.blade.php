@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Productos
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                
                                    

                                </div>
                        



                            </div>
                        </div>
                    </div>
                </div>

         
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script src="{{ asset('js/ajax-edit.js') }}"></script>
    @parent
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });  

        var data_form = $("#form-perfil");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_edit(url,'POST',formData,'#btn-guardar-perfil') 
        });
    </script> 
    
@endsection 