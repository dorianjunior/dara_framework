<?php

namespace App\Http\Controllers;

use App\Core\Request;

abstract class Controller {

    public function index(Request $request) {
        // Exemplo: retornar view de listagem
        return View::render('index', ['message' => 'Listagem de recursos']);
    }

    // Exibe detalhes de um recurso individual
    public function show(Request $request, $id) {
        // Exemplo: retornar view com os detalhes do recurso
        return View::render('show', ['id' => $id, 'message' => 'Detalhe do recurso']);
    }

    // Exibe o formulário para criação de um novo recurso
    public function create(Request $request) {
        // Exemplo: retornar view com formulário de criação
        return View::render('create', ['message' => 'Formulário de criação']);
    }

    // Processa o armazenamento dos dados enviados para criação de um recurso
    public function store(Request $request) {
        // Exemplo: processar criação de recurso
        $data = $request->all();
        // Aqui a lógica para salvar os dados
        return View::json(['message' => 'Recurso criado com sucesso', 'data' => $data], 201);
    }

    // Exibe o formulário para edição do recurso existente
    public function edit(Request $request, $id) {
        // Exemplo: retornar view com formulário de edição
        return View::render('edit', ['id' => $id, 'message' => 'Formulário de edição']);
    }

    // Atualiza os dados do recurso existente
    public function update(Request $request, $id) {
        // Exemplo: processar atualização do recurso
        $data = $request->all();
        // Aqui a lógica para atualizar os dados do recurso
        return View::json(['message' => "Recurso {$id} atualizado com sucesso", 'data' => $data], 200);
    }

    // Deleta um recurso existente
    public function destroy(Request $request, $id) {
        // Exemplo: processar remoção do recurso
        // Aqui a lógica para o delete do recurso
        return View::json(['message' => "Recurso {$id} removido com sucesso"], 200);
    }
}
