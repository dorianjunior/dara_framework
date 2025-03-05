<?php

namespace App\Http\Controllers;

use App\Http\Request;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        return $this->json(['message' => 'Lista de usuários']);
    }
    
    public function show(Request $request)
    {
        $id = $request->route('id');
        return $this->json(['message' => 'Detalhes do usuário', 'id' => $id]);
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        return $this->json(['message' => 'Usuário criado', 'data' => $data], 201);
    }
    
    public function update(Request $request)
    {
        $id = $request->route('id');
        $data = $request->all();
        return $this->json(['message' => 'Usuário atualizado', 'id' => $id, 'data' => $data]);
    }
    
    public function destroy(Request $request)
    {
        $id = $request->route('id');
        return $this->json(['message' => 'Usuário removido', 'id' => $id]);
    }
}
