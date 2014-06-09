<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Reclamacao
{
    
    /**
     * Empreendimento.
     *
     * @var \Condominio\Entity\Empreendimento
     */
    protected $condominio;
    protected $user;
    /**
     * Reclamacao id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Id do Usuario.
     *
     * @var integer
     */
    protected $idu;

    /**
     * Id do Empreendimento.
     *
     * @var integer
     */
    protected $idcond;
    
    /**
     * Id do Assunto da Reclamacao.
     *
     * @var integer
     */
    protected $idassunto;
    
    /**
     * Titulo.
     *
     * @var varchar 250
     */
    protected $titulo;
    /**
     * Dados do Imovel.
     *
     * @var varchar 250
     */
    protected $dados;
    /**
     * Descricao.
     *
     * @var text
     */
    protected $descricao;

    /**
     * Data de Cadastro.
     *
     * @var datetime
     */
    protected $dt_cadastro;
    
    protected $visita;
    
    protected $imagem;
    
    protected $files;
    
    protected $file1;
    protected $file2;
    protected $file3;
    protected $file4;

    protected $youtube;


    public function getId() {
        return $this->id;
    }

    public function getIdu() {
        return $this->idu;
    }

    public function getIde() {
        return $this->ide;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDt_cadastro() {
        return $this->dt_cadastro;
    }
    public function getIdassunto() {
        return $this->idassunto;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    
    public function getDados() {
        return $this->dados;
    }

    public function setId($id) {
        $this->id = $id;
    }
    /**
     * Idu do usuário.
     *
     * @var int
     */
    public function setIdu($idu) {
        $this->idu = $idu;
    }
    /**
     * Id do empreendimento.
     *
     * @var int
     */
    public function setIde($ide) {
        $this->ide = $ide;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDt_cadastro(\DateTime $dt_cadastro) {
        $this->dt_cadastro = $dt_cadastro;
    }
    public function setIdassunto($idassunto) {
        $this->idassunto = $idassunto;
        return $this;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;
    }

    public function setDados($dados) {
        $this->dados = $dados;
        return $this;
    }
    public function getEmpreendimento() {
        return $this->empreendimento;
    }

    public function setEmpreendimento($empreendimento) {
        $this->empreendimento = $empreendimento;
        return $this;
    }
    public function getVisita() {
        return $this->visita;
    }

    public function setVisita($visita) {
        $this->visita = $visita;
        return $this;
    }
    public function getYoutube() {
        return $this->youtube;
    }

    public function setYoutube($youtube) {
        $this->youtube = $youtube;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    public function getFile1() {
        return $this->file1;
    }

    public function getFile2() {
        return $this->file2;
    }

    public function getFile3() {
        return $this->file3;
    }

    public function getFile4() {
        return $this->file4;
    }

    public function setFile1($file1) {
        $this->file1 = $file1;
        return $this;
    }

    public function setFile2($file2) {
        $this->file2 = $file2;
        return $this;
    }

    public function setFile3($file3) {
        $this->file3 = $file3;
        return $this;
    }

    public function setFile4($file4) {
        $this->file4 = $file4;
        return $this;
    }
    public function getFiles() {
        return $this->files;
    }

    public function setFiles($files) {
        $this->files = $files;
        return $this;
    }
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }


    public function getIdcond() {
        return $this->idcond;
    }

    public function setIdcond($idcond) {
        $this->idcond = $idcond;
    }
    public function getCondominio() {
        return $this->condominio;
    }

    public function setCondominio($condominio) {
        $this->condominio = $condominio;
    }




}
