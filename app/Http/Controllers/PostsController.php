<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();

        try {
            $file = $request->file('img_post');
            $post->img_post = $file->getClientOriginalName();
            $file->move('images', $post->img_post);
        } catch (\Exception $e) {
            return "Ocorreu um erro: {$e->getMessage()}";
        }

        $post->titulo = $request->post['titulo'];
        $post->conteudo = $request->post['conteudo'];
        $post->user_id = 1; // Pegar user_id dinamicamente
        $post->categoria_id = $request->post['categoria_id'];

        return $post->save() ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $cat = Categoria::find($post->categoria_id);
        $user = User::find($post->user_id);
        $array_post = [
            'id' => $post->id,
            'titulo' => $post->titulo,
            'img_post' => $post->img_post,
            'conteudo' => $post->conteudo,
            'created_at' => (new Carbon($post->created_at))->format('d/m/Y h:i:s'),
            'updated_at' => (new Carbon($post->updated_at))->format('d/m/Y h:i:s'),
            'categoria' => $cat->nome,
            'autor' => $user->name,
            'email' => $user->email
        ];
        return view('blog.posts.show', ['post' => $array_post]);
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
        if ($post = Post::find($id)) {
            $img_post = $post->img_post;
            if ($post->delete($id)) {
                if (file_exists(public_path('/images/' . $img_post))) {
                    unlink(public_path('/images/' . $img_post));
                }
            }

            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Busca posts por termos presentes no nome.
     */
    public function buscar()
    {
        $termos = request('termos');
        $tipo = request('tipo');
        $filtro = json_decode(request('filtro'));

        switch ($tipo) {
            case 2: // Por categoria
                $data = DB::table('posts')->where('categoria_id', $filtro->categoria)->get();
                break;
            case 3: // Por autor
                $data = DB::table('posts')
                    ->join("users", "users.id", "=", "user_id")
                    ->where('name', 'LIKE', '%' . $filtro->autor . '%')
                    ->get();
                break;
            default:
                $termos = (($filtro instanceof \stdClass) && $filtro->titulo) ? $filtro->titulo : $termos;
                $data = DB::table('posts')->where('titulo', 'LIKE', '%' . $termos . '%')->get();
        }

        $posts = [];

        foreach ($data as $d) {

            $posts[] = [
                'id' => $d->id,
                'titulo' => $d->titulo,
                'img_post' => $d->img_post,
                'created_at' => (new Carbon($d->created_at))->format('d/m/Y h:i:s'),
                'updated_at' => (new Carbon($d->updated_at))->format('d/m/Y h:i:s')
            ];
        }

        return $posts;
    }
}
