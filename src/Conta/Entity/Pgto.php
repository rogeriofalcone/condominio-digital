<?php

namespace Conta\Entity;


class Pgto
{
    /**
     * Artist id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Artist name.
     *
     * @var string
     */
    protected $name;

    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}
