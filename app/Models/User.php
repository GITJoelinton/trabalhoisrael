<?php
namespace App\Models;

class User {
    public ?int $id;
    public string $username;
    public string $senha; 
    public string $created_at;

    public function __construct(
        ?int $id, 
        string $username, 
        string $senha, 
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->senha = $senha;
        $this->created_at = $created_at;
    }
}