<td>{{$movie->titulo}}</td>
<td>{{$movie->categoria}}</td>
<td>                            
    {!!Form::open(['route'=> ['home.update',$movie->id], 'method'=>'PUT', 'id'=>'guardar'.$movie->idMovie.''])!!}
         <input type="number" min="0" max="10" name="valoracion" value="{{$movie->valoracion}}" class="input-sm">
       

        {!!Form::hidden('user_id', $user_id,['form'=>'guardar'.$movie->idMovie.''])!!}
        {!!Form::hidden('movie_id', $movie->idMovie)!!}
        {!!Form::hidden('fecha', $date)!!}
    {!!Form::close()!!} 
</td>
<td>{{$movie->total}}</td>
<td>{{number_format($movie->promedio, 2, '.', '')}}</td>
<td> 
    <button type="submit" class="btn btn-success"  form="guardar{{$movie->idMovie}}" >Guardar</button>
</td>                
<td>
    {!!Form::open(['route'=>['home.destroy',$movie->id],'method'=>'DELETE'])!!}
         <button type="submit" class="btn btn-danger" >Eliminar</button>

    {!!Form::close()!!} 
</td>