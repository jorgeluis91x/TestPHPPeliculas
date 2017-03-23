@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="content table-responsive table-full-width ">
            <table class="table table-hover table-striped">

                <thead>
                    <th>Pelicula</th>
                    <th>Categoría</th>
                    <th>Valoracion</th>
                    <th>Total Clientes</th>
                    <th>Promedio</th>
                    <th>Guardar</th>
                    <th>Eliminar</th>
                </thead>

                <!--inicio un producto -->

                @foreach($movies as $movie)

                <tbody>
                
                    @if($movie->valoracion)
                        @include('layouts.forms.edit')
                           
                    @else
                        @include('layouts.forms.create')  
                    @endif  
                    

                </tbody>
                @endforeach

            </table>

        </div>
    </div>
</div>
@endsection
