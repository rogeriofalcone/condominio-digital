<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Informativo
{
    protected $id;
    protected $idu;
    protected $assunto;
    protected $dtenvio;
    protected $conteudo;


    public function getId() {
        return $this->id;
    }

    public function getIdu() {
        return $this->idu;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function getDtenvio() {
        return $this->dtenvio;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdu($idu) {
        $this->idu = $idu;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setDtenvio($dtenvio) {
        $this->dtenvio = $dtenvio;
    }
    public function getConteudo() {
        return $this->conteudo;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }



}
