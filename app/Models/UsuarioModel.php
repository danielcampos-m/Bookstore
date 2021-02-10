<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $table = 'usuarios';

    protected $allowedFields = ['nome','email', 'senha'];

    public function getDadosByEmail($email = null){
        $modelUsuario = model('UsuarioModel');
        $usuario = $modelUsuario->where([
            'email' => $email
        ])->findAll();

        if(count($usuario)>0){
            return $usuario[0];
        }else{
            return false;
        }
    }
}