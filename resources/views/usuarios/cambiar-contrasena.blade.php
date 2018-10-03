@extends('layouts.app') @section('contenido')


     
   <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="title-section">Cambiar Contrase&ntilde;a</p>
            </div>
        </div>
    </div>
    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-12 mt20">
                    <div class="dashboard">
                        <div class="row">
                            <div class="col-sm-12">
                            

                                 <form action="{{ route('update.password') }}" method="post" role="form" id="form-contrasenia">
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="last_name">Nueva Contraseña</label>
                                <div class="input-box">
                                    <input type="password" name="password" id="new-pass" class="form-control" title="Nueva contraseña" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="phone">Repetir Contraseña</label>
                                <div class="input-box">
                                    <input type="password" name="password_confirmation" id="re-pass" class="form-control" title="Repetir contraseña" required>
                                </div>
                            </div>
                        </div>
                       <div class="col-sm-12">
                                    <div class="buttons-set">
                                        <button type="submit" class="primary-btn" style="float: right" title="Guardar" name="send" id="btn-guardar-perfil"><i class="fa fa-database"></i><span class="btn-text"> Guardar</span></button>
                                    </div>
                                </div>
                    </form>






















                            </div>
                        </div>
                    </div>
                </div>

                            @include('layouts.menu-perfil')
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

        var data_form = $("#form-contrasenia");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_edit(url,'POST',formData,'#btn-guardar-perfil') 
        });
    </script> 
    
@endsection 