<?php

namespace Condominio\Entity;


class Imagem
{
    
    private $id;
    private $idr;
    private $file;
    public $files; 
    
      // GETTERS & SETTERS ...

    public function getFiles() {
        return $this->files;
    }
    public function setFiles(array $files) {
        $this->files = $files;
    }

    public function __construct() {
        $files = array();
    }
    
    
    public function getId() {
        return $this->id;
    }

    public function getIdr() {
        return $this->idr;
    }

    public function getFile() {
        return $this->file;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdr($idr) {
        $this->idr = $idr;
    }

    public function setFile($file) {
        $this->file = $file;
    }



}
