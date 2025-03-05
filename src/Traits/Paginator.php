<?php

namespace App\Traits;

trait Paginator {
    public static function buildPaginationParams($page = 1, $limit = 10) {
        $page = max(1, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1);
        $limit = max(1, min(100, filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT) ?? 10));
        
        return [
            'page' => $page,
            'limit' => $limit,
            'offset' => ($page - 1) * $limit
        ];
    }
}
