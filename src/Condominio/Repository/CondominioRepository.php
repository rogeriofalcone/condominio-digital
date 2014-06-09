<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Condominio;

/**
 * Condominio repository
 */
class CondominioRepository implements RepositoryInterface
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
     * Saves the condominio to the database.
     *
     * @param \Condominio\Entity\Condominio $condominio
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
            $this->db->update('tmp_condominio', $empData, array('id' => $emp->getId()));
        }else {
            $this->db->insert('tmp_condominio', $empData);             
            $id = $this->db->lastInsertId();
            $emp->setId($id);
        }
    }

    /**
     * Deletes the condominio.
     *
     * @param \Condominio\Entity\Condominio $condominio
     */
    public function delete($condominio)
    {
        // If the condominio had an image, delete it.
        $image = $condominio->getImage();
        if ($image) {
            unlink('images/condominio/' . $image);
        }
        return $this->db->delete('condominio', array('id' => $condominio->getId()));
    }

    /**
     * Returns the total number of condominio.
     *
     * @return integer The total number of condominio.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM condominio');
    }
    public function getCountBusca($busca) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM condominio where nome like '%$busca%'");
    }
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('condominio', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Returns an condominio matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $condominioData = $this->db->fetchAssoc('SELECT * FROM condominio WHERE id = ?', array($id));
        return $condominioData ? $this->buildCondominio($condominioData) : FALSE;
    }
    /**
     * Returns an condominio matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function findIdNome($id)
    {
        $condominioData = $this->db->fetchAssoc('SELECT * FROM condominio WHERE idnome = ?', array($id));
        return $condominioData ? $this->buildCondominio($condominioData) : FALSE;
    }

    /**
     * Returns a collection of condominio, sorted by name.
     *
     * @param integer $limit
     *   The number of condominio to return.
     * @param integer $offset
     *   The number of condominio to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of condominio, keyed by condominio id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('visita' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('condominio', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $condominioData = $statement->fetchAll();

        $condominio = array();
        foreach ($condominioData as $condominioData) {
            $condominioId = $condominioData['id'];
            $condominio[$condominioId] = $this->buildCondominio($condominioData);
        }
        return $condominio;
    }
    /**
     * Returns a collection of condominio, sorted by name.
     *
     * @return array A collection of condominio, keyed by condominio id.
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
            ->from('condominio', 'a');
            $queryBuilder->setMaxResults($limit);
            $queryBuilder->setFirstResult($offset);
            
            if($like){
                 $queryBuilder->where("a.nome like '%$like%'");
            }
            
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        
        
        $condominioData = $statement->fetchAll();

        $condominio = array();
        foreach ($condominioData as $condominioData) {
            $condominioId = $condominioData['id'];
            $condominio[$condominioId] = $this->buildCondominio($condominioData);
        }
        return $condominio;
    }

    /**
     * Instantiates an condominio entity and sets its properties using db data.
     *
     * @param array $condominioData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Condominio
     */
    protected function buildCondominio($condominioData)
    {
        $condominio = new Condominio();
        $condominio->setId($condominioData['id']);
        $condominio->setIdnome($condominioData['idnome']);
        $condominio->setIde($condominioData['ide']);
        $condominio->setNome(utf8_encode($condominioData['nome']));
        $condominio->setBairro($condominioData['bairro']);
        $condominio->setCidade($condominioData['cidade']);
        $condominio->setUf($condominioData['uf']);
        $condominio->setVisita($condominioData['visita']);
        return $condominio;
    }
}
