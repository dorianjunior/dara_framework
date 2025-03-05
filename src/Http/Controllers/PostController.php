<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\View;

class PostController {
    // Exemplo: GET /posts
    public function index(Request $request) {
        // Aqui você pode utilizar o Model específico (via herança ou injeção de dependência)
        $postModel = new Post(); // considere ter uma classe concreta Post estendendo Model
        $posts = $postModel->all();
        // Resposta JSON para API ou renderização de view para web
        return View::json($posts);
    }
    
    // Exemplo: POST /posts
    public function store(Request $request) {
        // Validação de inputs estilo Laravel
        $request->validate(['title' => 'required', 'content' => 'required']);
        $data = $request->all();
        $postModel = new Post();
        $id = $postModel->create($data);
        return View::json(['message' => 'Post criado', 'id' => $id], 201);
    }
}
