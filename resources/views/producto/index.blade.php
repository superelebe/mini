@extends('layouts.admin')

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
                <div class="col-12">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <form  method = 'get' action = '{{url("/home")}}'>
                                        <button class="button-two" type = 'submit'><span class="texto_blanco">ADMIN</span></button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form class = 'col s3' method = 'get' action = '{!!url("producto")!!}/create'>
                                        <div class="sub-main">
                                          <button class="button-two" type = 'submit'><span class="texto_blanco">Crear nuevo Producto</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">                            
                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <td>Producto</td>
                                            <td>categoria</td>
                                            <td>subcategoria</td>
                                            <td>Imagen</td>
                                            <td>Orden</td>
                                            <td>BORRAR</td>
                                            <td>EDITAR</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($productos as $producto) 
                                        <tr>
                                            <td> 
                                                {{$producto->nombre}}
                                            </td>
                                            <td>
                                                {{$producto->cate->nombre}}
                                            </td>
                                            <td>
                                                {{$producto->subcate->nombre}}
                                            </td>
                                            <td>
                                                <img class='ancho_imagen_adminis' src="{!!$producto->imagen!!}" alt=""> 
                                            </td>
                                            <td>
                                                {{$producto->orden}}
                                            </td>
                                            <td>
                                                <form action="{{ route('producto.destroy', ['id' => $producto->id]) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('producto.edit', $producto->id) }}" class = 'viewEdit btn btn-primary btn-xs' data-link = '/subcategoria/{!!$producto->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                                            </td>
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {!! $productos->links() !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection