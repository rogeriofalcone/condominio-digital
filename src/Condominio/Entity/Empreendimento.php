<?php

namespace Condominio\Entity;


class Empreendimento
{
    protected $empresa;
    /**
     * Reclamacao id.
     *
     * @var integer
     */
    protected $id;
    protected $idnome;
    protected $idu;
    protected $nome;
    protected $nomecons;
    /**
     * IdNome do Empreendimento.
     *
     * @var integer
     */
    
    /**
     * Reclamacao ide empresa.
     *
     * @var integer
     */
    protected $rua;
    protected $latilong;
    /**
     * Bairro.
     *
     * @var vahchar 250
     */
    protected $bairro;
    protected $uf;
    protected $cidade;    
    protected $ide;    
    protected $visita;
    
    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
        return $this;
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdnome() {
        return $this->idnome;
    }

    public function getRua() {
        return $this->rua;
    }

    public function getLatilong() {
        return $this->latilong;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getUf() {
        return $this->uf;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getIde() {
        return $this->ide;
    }

    public function getVisita() {
        return $this->visita;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIdnome($idnome) {
        $this->idnome = $idnome;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function setLatilong($latilong) {
        $this->latilong = $latilong;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setIde($ide) {
        $this->ide = $ide;
    }

    public function setVisita($visita) {
        $this->visita = $visita;
    }
    public function getIdu() {
        return $this->idu;
    }

    public function setIdu($idu) {
        $this->idu = $idu;
    }

    public function getNomecons() {
        return $this->nomecons;
    }

    public function setNomecons($nomecons) {
        $this->nomecons = $nomecons;
    }








}
