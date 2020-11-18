<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    
    public function index()
    {
        return Film::all();
    }
    
    public function getFilmbyId($id){
        $film = DB::table('films')->where('id', $id)->first();
        if($film){
            return response()->json(['message'=>'Success', 'data'=>$film], 200);
        }else{
            return response()->json(['message'=>'FIlm Tidak Ditemukan'], 404);
        }

    }

    public function FilmStore(Request $request)
  {
        $this->validate($request, [
        'judul' => 'required',
        'deskripsi' => 'required',
        'author' => 'required'
        ]);

        $film = Film::create(
        $request->only(['judul', 'deskripsi', 'author'])
        );

        return response()->json([
        'created' => true,
        'data' => $film
        ], 201);
  }

  public function FilmUpdate(Request $request, $id){
    try {
    $film = Film::findOrFail($id);
    } catch (ModelNotFoundException $e) {
    return response()->json([
        'message' => 'film tidak ditemukan'
    ], 404);
    }

    $film->fill(
    $request->only(['judul', 'deskripsi', 'author'])
    );
    $film->save();

    return response()->json([
    'updated' => true,
    'data' => $film
    ], 200);
}

public function FilmDestroy($id){
    try {
    $film = Film::findOrFail($id);
    } catch (ModelNotFoundException $e) {
    return response()->json([
        'error' => [
        'message' => 'film tidak ditemukan'
        ]
    ], 404);
    }

    $film->delete();

    return response()->json([
    'deleted' => true
    ], 200);
}
    
}