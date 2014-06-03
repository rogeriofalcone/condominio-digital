<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Video
{
    
    protected $id;
    protected $link;
    protected $dtCadastro;
    

    public function getId() {
        return $this->id;
    }

    public function getLink() {
        return $this->link;
    }

    public function getDtCadastro() {
        return $this->dtCadastro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setDtCadastro($dtCadastro) {
        $this->dtCadastro = $dtCadastro;
    }




}
