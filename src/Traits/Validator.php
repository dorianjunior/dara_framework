<?php

namespace App\Traits;

trait Validator {
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct(array $data, array $rules) {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function fails() {
        foreach($this->rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach($rules as $r) {
                if ($r == 'required' && empty($this->data[$field])) {
                    $this->errors[$field][] = "O campo {$field} é obrigatório";
                }
                // Outras regras podem ser implementadas aqui...
            }
        }
        return count($this->errors) > 0;
    }

    public function errors() {
        return $this->errors;
    }
}
