<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Perfil
{
    protected $id;
    protected $nome;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }


}
