@extends('layouts.app')

@section('content')

<div id="app">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title"><strong>{{ $post['titulo'] }}</strong> - <small class="text-info">{{ $post['categoria'] }}</small></h5>
            <p class="card-text">
                <img class="card-img-top" src="/images/{{ $post['img_post'] }}" alt="Card image cap" style="width: 350px; padding: 0px 3px 3px 0px; border: solid 1px #f1f1f1;">
                {{ $post['conteudo'] }}
            </p>

            <p>
                <small><strong>Autor:</strong> <span class="text-info">{{ $post['autor'] }}</span></small> | 
                <small><strong>e-mail:</strong> <span class="text-info">{{ $post['email'] }}</span></small>
                <br>
                <small><strong>Criado em:</strong> <span class="text-info">{{ $post['created_at'] }}</span></small>
                <br>
                <small><strong>Última atualização:</strong> <span class="text-info">{{ $post['updated_at'] }}</span></small>
            </p>
            
            <a href="/posts" class="btn btn-primary">Voltar para posts</a>
        </div>
    </div>
</div>
@endsection