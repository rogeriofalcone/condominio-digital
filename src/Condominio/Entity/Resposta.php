<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Resposta
{
    protected $empreendimento;
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
    protected $iduser;

    /**
     * Id do Empreendimento.
     *
     * @var integer
     */
    protected $ide;
    /**
     * Id do Reclamacao
     *
     * @var integer
     */
    protected $idr;
    
    /**
     * Id do Assunto da Reclamacao.
     *
     * @var integer
     */
    protected $dtResposta;
    
    /**
     * Titulo.
     *
     * @var varchar 250
     */
    protected $avaliacao;
    /**
     * Dados .
     *
     * @var text
     */
    protected $resposta;
    /**
     * Descricao.
     *
     * @var text
     */
 

    public function getEmpreendimento() {
        return $this->empreendimento;
    }

    public function getUser() {
        return $this->user;
    }

    public function getId() {
        return $this->id;
    }

    public function getIduser() {
        return $this->iduser;
    }

    public function getIde() {
        return $this->ide;
    }

    public function getIdr() {
        return $this->idr;
    }

    public function getDtResposta() {
        return $this->dtResposta;
    }

    public function getAvaliacao() {
        return $this->avaliacao;
    }

    public function getResposta() {
        return $this->resposta;
    }

    public function setEmpreendimento($empreendimento) {
        $this->empreendimento = $empreendimento;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIduser($iduser) {
        $this->iduser = $iduser;
    }

    public function setIde($ide) {
        $this->ide = $ide;
    }

    public function setIdr($idr) {
        $this->idr = $idr;
    }

    public function setDtResposta($dtResposta) {
        $this->dtResposta = $dtResposta;
    }

    public function setAvaliacao($avaliacao) {
        $this->avaliacao = $avaliacao;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }



}
