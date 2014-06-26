<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\TipoUsuario;

/**
 * Condominio repository
 */
class TipoUsuarioRepository implements RepositoryInterface
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
     * Saves the tipousuario to the database.
     *
     * @param \Condominio\Entity\Condominio $tipousuario
     *   protected 'empresa' => null
            protected 'id' => null
            protected 'idnome' => null
            protected 'idu' => string '1' (length=1)
            protected 'nome' => string 'aaaaaaaaaaaaaaaaa' (length=17)
            protected 'nomecons' => string 'aaaaaaaaaaaa' (length=12)
            protected 'rua' => null
            protected 'latilong' => null
            protected 'bairro' => null
            protected 'uf' => string 'RJ' (length=2)
            protected 'cidade' => null
            protected 'ide' => null
            protected 'visita' => null
     */
    public function save($emp){        
    }
    
    public function saveTmp($emp)
    {
        $empData = array(
            'idu' => $emp->getIdu(),
            'idnome' => $emp->getIdNome(),
            'nome' => $emp->getNome(),
            'nomecons' => $emp->getNomecons(),
            'rua' => $emp->getRua(),
            'bairro' => $emp->getBairro(),
            'uf' => $emp->getUf(),
            'cidade' => $emp->getCidade(),
        );

        if ($emp->getId()) {
            $this->db->update('tmp_tipousuario', $empData, array('id' => $emp->getId()));
        }else {
            $this->db->insert('tmp_tipousuario', $empData);             
            $id = $this->db->lastInsertId();
            $emp->setId($id);
        }
    }

    /**
     * Deletes the tipousuario.
     *
     * @param \Condominio\Entity\Condominio $tipousuario
     */
    public function delete($tipousuario)
    {
        // If the tipousuario had an image, delete it.
        $image = $tipousuario->getImage();
        if ($image) {
            unlink('images/tipousuario/' . $image);
        }
        return $this->db->delete('tipousuario', array('id' => $tipousuario->getId()));
    }

    /**
     * Returns the total number of tipousuario.
     *
     * @return integer The total number of tipousuario.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM tipousuario');
    }
    public function getCountBusca($busca) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM tipousuario where nome like '%$busca%'");
    }
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('tipousuario', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Returns an tipousuario matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        exit("LLL");
        $tipousuarioData = $this->db->fetchAssoc('SELECT * FROM tipousuario WHERE id = ?', array($id));
        return $tipousuarioData ? $this->buildCondominio($tipousuarioData) : FALSE;
    }
    /**
     * Returns an tipousuario matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function findIdNome($id)
    {
        $tipousuarioData = $this->db->fetchAssoc('SELECT * FROM tipousuario WHERE idnome = ?', array($id));
        return $tipousuarioData ? $this->buildCondominio($tipousuarioData) : FALSE;
    }

    /**
     * Returns a collection of tipousuario, sorted by name.
     *
     * @param integer $limit
     *   The number of tipousuario to return.
     * @param integer $offset
     *   The number of tipousuario to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of tipousuario, keyed by tipousuario id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            //$orderBy = array('' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('tipousuario', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
        $statement = $queryBuilder->execute();
        $tipousuarioData = $statement->fetchAll();

        $tipousuario = array();
        foreach ($tipousuarioData as $tipousuarioData) {
            $tipousuarioId = $tipousuarioData['id'];
            $tipousuario[$tipousuarioId] = $this->buildCondominio($tipousuarioData);
        }
        return $tipousuario;
    }
    /**
     * Returns a collection of tipousuario, sorted by name.
     *
     * @return array A collection of tipousuario, keyed by tipousuario id.
     */
    public function findAllWhere($limit, $offset = 0, $orderBy = array(), $like=null)
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('visita' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('tipousuario', 'a');
            $queryBuilder->setMaxResults($limit);
            $queryBuilder->setFirstResult($offset);
            
            if($like){
                 $queryBuilder->where("a.nome like '%$like%'");
            }
            
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        
        
        $tipousuarioData = $statement->fetchAll();

        $tipousuario = array();
        foreach ($tipousuarioData as $tipousuarioData) {
            $tipousuarioId = $tipousuarioData['id'];
            $tipousuario[$tipousuarioId] = $this->buildCondominio($tipousuarioData);
        }
        return $tipousuario;
    }

    /**
     * Instantiates an tipousuario entity and sets its properties using db data.
     *
     * @param array $tipousuarioData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Condominio
     */
    protected function buildCondominio($tipousuarioData)
    {
        $tipousuario = new TipoUsuario();
        $tipousuario->setId($tipousuarioData['id']);
        $tipousuario->setNome($tipousuarioData['nome']);
        return $tipousuario;
    }
}
