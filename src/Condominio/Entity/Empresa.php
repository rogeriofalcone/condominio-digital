<?php

namespace Condominio\Entity;


class Empresa
{
    
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $uf;
    private $cidade;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getUf() {
        return $this->uf;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }

    public function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
        return $this;
    }


}
