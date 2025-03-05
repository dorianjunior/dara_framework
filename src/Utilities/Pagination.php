<?php

namespace App\Utilities;

class Pagination {
    protected $page;
    protected $limit;
    protected $order;
    
    public function __construct($page, $limit, $order) {
        $this->page = $page;
        $this->limit = $limit;
        $this->order = $order;
    }
    
    // Retorna SQL de LIMIT e OFFSET
    public function getSQL() {
        $offset = ($this->page - 1) * $this->limit;
        return "LIMIT {$this->limit} OFFSET {$offset}";
    }
    
    // Gera links de navegação (exemplo simples)
    public function links($total) {
        $pages = ceil($total / $this->limit);
        $links = [];
        for ($i = 1; $i <= $pages; $i++) {
            $links[$i] = "?page={$i}&limit={$this->limit}&order={$this->order}";
        }
        return $links;
    }
}
