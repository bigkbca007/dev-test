<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();

        $categoria->nome = $request->categoria['nome'];
        // Pegar dinamicamente
        $categoria->user_id = 1;

        return $categoria->save() ? 1 : 0;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($categoria = Categoria::find($id)){
            $categoria->delete($id);
            
            return 1;
        } else {
            return 0;
        }

    }

    /**
     * Pega opções para o combo de categorias.
     */
    public function getOptions()
    {
        $data = Categoria::orderBy('nome')->get();
        $categorias = [];
        foreach($data as $d){
            $categorias[] = ['id' => $d->id, 'nome' => $d->nome];
        }

        return $categorias;
    }

    /**
     * Busca categorias por termos presentes no nome.
     */
    public function buscar(){
        $termos = request('termos');
        $data = DB::table('categorias')->where('nome', 'LIKE', '%'.$termos.'%')->get();

        $categorias = [];

        foreach($data as $d){
            $categorias[] = ['id' => $d->id, 'nome' => $d->nome];
        }

        return $categorias;
    }
}
