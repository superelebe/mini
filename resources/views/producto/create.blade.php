@extends('layouts.admin')
    <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea',plugins: "lists" });</script>
@section('contenido')
    <div class="content-wrapper">
        <div class="container-fluid">

            @if(Session::has('info'))
                <div class="alert alert-info">
                    {{ Session::get('info') }}
                </div>
            @endif
            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{url('/home')}}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">My Dashboard</li>
            </ol>

        <!-- Icon Cards -->
            <div class="row">
                <div class="col-12 col-centered">
                    <div class="row">
                        <div class="col-6 col-centered">
                            <form  method = 'get' action = '{{url("/home")}}'>
                                <button class="btn btn-primary" type = 'submit'><span class="texto_blanco">DASHBOARD</span></button>
                            </form>
                        </div>
                        <div class="col-6 col-centered">
                            <form method = 'get' action = '{!!url("producto")!!}'>
                                <button class = 'btn btn-danger'>Ver todos los Productos</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="col-8 col-centered">
                    <div class='titulo_seccion'>
                        Crear Producto
                    </div class='titulo_seccion'>
                </div>

                @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                <div class="col-8 col-centered formularios">
                    <form method = 'POST' action = '{!!url("producto")!!}' enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <meta name="_token" content="{!! csrf_token() !!}">
                        <div class="form-group m-b-20">
                            <label for="titulo">Nombre</label>
                            <input id="titulo" name = "nombre" type="text" class="form-control">
                        </div>
                        <div class="form-group m-b-20">
                            <label for="imagen">Portada</label>
                            <input id="imagen" name = "imagen" type="file" class="form-control">
                        </div>

                        <div class="form-group m-b-20">
                            <label for="descrip">Descripcion</label>
                            <textarea  id="descripcion" name = "descrip" type="text" class="form-control"></textarea>
                        </div>
                        <div class="form-group m-b-20">
                            <label for="orden">Orden</label>
                            <input id="orden" name = "alter" type="number" class="form-control">
                        </div>
                        <div class="form-group m-b-20">
                            <label for="color">Color</label>
                            <select required id='color' class="form-control" name="id_color">
                                <option value="" selected disabled style="display:none">Seleciona un color</option>
                                @foreach($colores as $color)
                                    <option value="{{$color->id}}">{{$color->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-b-20">
                            <label for="orden">Subir Fotos</label>
                            <input id="photos" type="file" name="photos[]" multiple class="form-control">
                        </div>

                        <div class="form-group m-b-20">
                            <label for="orden">Tallas</label>
                            @foreach($tallas as $talla)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="arrayTallas[]" value="{{ $talla->id }}">
                                        {{ $talla->numero }}
                                    </label>
                                </div>
                            @endforeach 
                        </div>
                        <div class="form-group m-b-20">
                            <label for="orden">Activo</label>
                            <select class="form-control" name="sino">
                                <option selected="selected"  value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group m-b-20">
                            <label for="orden">Categoria</label>
                            <select id='cate' class="form-control" name="id_categoria">
                                <option value="" selected disabled style="display:none">Seleciona una categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" m-b-20 form-group{{ $errors->has('subcate') ? ' has-error' : '' }}">
                            <label for="subcate" class="col-md-12 control-label">Sub Categoria</label>
                            <select name="id_subcategoria" class="form-control" id='subcate'>
                                <option value="" selected disabled style="display:none">Sub Categoria</option>
                            </select>
                        </div>
                        <div class="sub-main_crear m-b-20">
                          <button class="button-two_crear" type = 'submit'><span class="texto_blanco">Crear</span></button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
<script>


    $(document).ready(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        })

        $('#photos').on('change', function(e){
            var cosa = e.target.value;
            console.log(cosa);
        });


        $('#cate').append(' Please choose one');
        $('#cate').on('change',function(e){
            var potato = e.target.value;
            var liga = "{{ url('ajaxSucate/') }}";
            console.log(potato);
            $.get(liga+'/'+potato+'', function(data){

                $('#subcate').empty();
                $('#subcate').append('<option>Elije una opcion </option>');
                console.log(data);
                $.each(data, function(index, subcateObj){
                    $('#subcate').append('<option value="'+ subcateObj.id+'">'+ subcateObj.nombre +'</option>');
                });
            });
        });
    });
</script>
@endsection
