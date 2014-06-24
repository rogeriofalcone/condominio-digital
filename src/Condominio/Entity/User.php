<?php

namespace Condominio\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Username.
     *
     * @var string
     */
    protected $username;

    /**
     * Salt.
     *
     * @var string
     */
    protected $salt;

    /**
     * Password.
     *
     * @var integer
     */
    protected $password;

    /**
     * Email.
     *
     * @var string
     */
    protected $mail;

    /**
     * Role.
     *
     * ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    protected $role;

    /**
     * The filename of the main artist image.
     *
     * @var string
     */
    protected $image;

    /**
     * When the artist entity was created.
     *
     * @var DateTime
     */
    protected $createdAt;
    protected $idcond;
    protected $name;
    
    protected $bloco;
    protected $ap;
    protected $cel;
    protected $tel;
    protected $comp;




    /**
     * The temporary uploaded file.
     *
     * $this->image stores the filename after the file gets moved to "images/".
     *
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    protected $file;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @inheritDoc
    */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getImage() {
        // Make sure the image is never empty.
        if (empty($this->image)) {
            $this->image = 'placeholder.gif';
        }

        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    public function getIdcond() {
        return $this->idcond;
    }

    public function getName() {
        return $this->name;
    }

    public function setIdcond($idcond) {
        $this->idcond = $idcond;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getBloco() {
        return $this->bloco;
    }

    public function getAp() {
        return $this->ap;
    }

    public function getCel() {
        return $this->cel;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setBloco($bloco) {
        $this->bloco = $bloco;
    }

    public function setAp($ap) {
        $this->ap = $ap;
    }

    public function setCel($cel) {
        $this->cel = $cel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }
    public function getComp() {
        return $this->comp;
    }

    public function setComp($comp) {
        $this->comp = $comp;
    }




}
/*
 * <div class="col-md-10">
        <br />
         <div class="panel panel-default">
                <div class="panel-heading"><b>Todas Reclamações</b></div>
                        <div class="table-responsive">
                            <table class="table table-responsive" >
                                <tr>
                                    <td>Título</td>
                                    <td>Tipo</td>
                                    <td>Autor</td>
                                    <td>Data</td>
                                    <td>Status</td>
                                </tr>
                            {% for reclamacao in aLista %}
                                <tr>
                                    <td><a href="{{path('view')}}/{{reclamacao.id}}"><b>{{reclamacao.titulo}}</b></a></td>
                                    <td>TIPO</td>
                                    <td>{{reclamacao.user.name}} - Bloco: {{reclamacao.user.bloco}} - Ap: {{reclamacao.user.ap}}</td>
                                    <td>{{reclamacao.dt_cadastro.date}}</td>
                                    <td><span style="border-radius:10px;float: right;margin-left: 20px" class="label label-info left">Aberto</span></td>
                                </tr>
                            {% endfor %}
                            </table>
                        {% include "pagination_reclamacao.html.twig" %}
                        </div>
            </div>
    </div>  
 */