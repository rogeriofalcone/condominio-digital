<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Video;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * User repository
 */
class VideoRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Saves the user to the database.
     *
     * @param \Condominio\Entity\User $user
     */
    public function save($user)
    {
       
    }

    public function delete($id)
    {
        return $this->db->delete('usuario', array('id' => $id));
    }

    /**
     * Returns the total number of usuario.
     *
     * @return integer The total number of usuario.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM usuario');
    }

    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\User|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE idu = ?', array($id));
        return $userData ? $this->buildUser($userData) : FALSE;
    }
    public function bemVindo($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE idu = ? and bemvindo = 0', array($id));
        return $userData ? $this->buildUser($userData) : FALSE;
    }
    public function updateBemVindo($id)
    {
        $userData['bemvindo'] = 1;
        return $this->db->update('usuario', $userData, array('idu' => $id));
    }
    public function updateMeuCondominio($id,$userData)
    {
        return $this->db->update('usuario', $userData, array('idu' => $id));
    }
    
    public function isDados($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE idu = ?', array($id));
        
        $aErro = array();
        
        if(empty($userData['cpf'])){
            $aErro[0] = "Cpf não informado.";
        }
        if(empty($userData['dadosImovel'])){
            $aErro[1] = "Dados do imóvel não informado.";
        }
        if(empty($userData['telCelular'])){
            $aErro[2] = "Celular não informado.";
        }
        if(empty($userData['telResidencial'])){
            $aErro[3] = "Telefone residencial não informado.";
        }
        
        if(count($aErro)){
            return false;
        }else{
            return true;
        }
    }
    
    public function saveAdicional($user)
    {
        $userData = array(
            'cpf'=>$user->getCpf(),
            'dadosImovel'=>$user->getDadosImovel(),
            'telCelular'=>$user->getTelCelular(),
            'telResidencial'=>$user->getTelResidencial(),
            'telContato'=>$user->getTelContato()
        );

        if ($user->getIdu()) {
            $this->db->update('usuario', $userData, array('idu' => $user->getIdu()));
        }else {
            $this->db->insert('usuario', $userData);             
            $id = $this->db->lastInsertId();
            $user->setIdu($id);
        }
    }

    public function findAll($limit=30, $offset = 0, $orderBy = array())
    {        
         // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('video', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $empresaData = $statement->fetchAll();
        $empresa = array();
        foreach ($empresaData as $empresaData) {
            $empresaId = $empresaData['id'];
            $empresa[$empresaId] = $this->buildVideo($empresaData);
        }
        
     
        return $empresa;
    }

    protected function buildVideo($userData)
    {      
        $video = new Video();
        $video->setId($userData['id']);
        $video->setLink($userData['link']);
        $video->setDtCadastro($userData['dt_cadastro']);
        return $video;
    }
    

}
