<?php

namespace TestMovies\Http\Controllers;

use Illuminate\Http\Request;
use TestMovies\Movie;
use TestMovies\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Katzgrau\KLogger\Logger;
 


use Session;
use Redirect;

class RatingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $log = new Logger ("logs");// Do database work that throws an exception
        $log->error("An exception was thrown in ThisFunction()");

        $user_id = Auth::id();
        $movies = DB::table('movies')
            ->select(DB::raw('ratings.id as id,user_id,titulo,categories.categoria, movies.id as idMovie, 
                (SELECT valoracion from ratings WHERE user_id = '.$user_id.' and movie_id = idMovie) as valoracion,
                (SELECT count(user_id) FROM ratings where movie_id = idMovie GROUP by movie_id) as total,
                (SELECT AVG(valoracion) from ratings where movie_id = idMovie GROUP by movie_id) as promedio'))
            ->join('categories','categories.id','=','category_id')
            ->leftJoin('ratings','movies.id','=','ratings.movie_id')
            ->groupBy('titulo')
            ->get();
        
        $date = Carbon::now();
        return view('home',compact('movies','user_id','date'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $log = new Logger ("logs");// Do database work that throws an exception
        $log->error("json error:" .$request);  

        $this->validate($request, [
            'valoracion' => 'required|min:0|max:10',
        ]);

        Rating::create($request->all());
        return redirect('/home')->with('message','store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);
        $rating->fill($request->all());
        $rating->save();

        Session::flash('message','Valoracion Editado correctamente');

        return Redirect::to('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
                Rating::destroy($id);
                Session::flash('message','Rating eliminado correctamente');
                return Redirect::to('/home');

            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error','No se puede eliminar');
                return Redirect::to('/home');

            } 
    }
}
