<?php

namespace Condominio\Entity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class User implements AdvancedUserInterface
{
    private $idu;
    private $idemp;


    private $username;
    private $password;
    private $email;
    private $enabled;
    private $accountNonExpired;
    private $credentialsNonExpired;
    private $accountNonLocked;
    private $roles;
    
    private $cpf;
    private $dadosImovel;
    private $telCelular;
    private $telResidencial;
    private $telContato;
    private $name;

    public function __construct()
    {
    }
    public function getIdu() {
        return $this->idu;
    }

    public function setIdu($idu) {
        $this->idu = $idu;
    }

        /**
     * Gets the user email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return $this->accountNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDadosImovel() {
        return $this->dadosImovel;
    }

    public function getTelCelular() {
        return $this->telCelular;
    }

    public function getTelResidencial() {
        return $this->telResidencial;
    }

    public function getTelContato() {
        return $this->telContato;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDadosImovel($dadosImovel) {
        $this->dadosImovel = $dadosImovel;
    }

    public function setTelCelular($telCelular) {
        $this->telCelular = $telCelular;
    }

    public function setTelResidencial($telResidencial) {
        $this->telResidencial = $telResidencial;
    }

    public function setTelContato($telContato) {
        $this->telContato = $telContato;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function getIdemp() {
        return $this->idemp;
    }

    public function setIdemp($idemp) {
        $this->idemp = $idemp;
    }




}
