<?php

namespace Condominio\Entity;


class Documento
{
    protected $id;
    protected $titulo;
    protected $file;
    protected $data;

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getFile() {
        return $this->file;
    }

    public function getData() {
        return $this->data;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setData($data) {
        $this->data = $data;
    }


}
