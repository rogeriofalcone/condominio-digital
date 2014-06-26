<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Documento;

/**
 * Condominio repository
 */
class DocumentoRepository implements RepositoryInterface
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
     * Saves the documento to the database.
     *
     * @param \Condominio\Entity\Condominio $documento
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
            $this->db->update('tmp_documento', $empData, array('id' => $emp->getId()));
        }else {
            $this->db->insert('tmp_documento', $empData);             
            $id = $this->db->lastInsertId();
            $emp->setId($id);
        }
    }

    /**
     * Deletes the documento.
     *
     * @param \Condominio\Entity\Condominio $documento
     */
    public function delete($documento)
    {
        // If the documento had an image, delete it.
        $image = $documento->getImage();
        if ($image) {
            unlink('images/documento/' . $image);
        }
        return $this->db->delete('documento', array('id' => $documento->getId()));
    }

    /**
     * Returns the total number of documento.
     *
     * @return integer The total number of documento.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM documento');
    }
    public function getCountBusca($busca) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM documento where nome like '%$busca%'");
    }
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('documento', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Returns an documento matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        exit("LLL");
        $documentoData = $this->db->fetchAssoc('SELECT * FROM documento WHERE id = ?', array($id));
        return $documentoData ? $this->buildCondominio($documentoData) : FALSE;
    }
    /**
     * Returns an documento matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Condominio|false An entity object if found, false otherwise.
     */
    public function findIdNome($id)
    {
        $documentoData = $this->db->fetchAssoc('SELECT * FROM documento WHERE idnome = ?', array($id));
        return $documentoData ? $this->buildCondominio($documentoData) : FALSE;
    }

    /**
     * Returns a collection of documento, sorted by name.
     *
     * @param integer $limit
     *   The number of documento to return.
     * @param integer $offset
     *   The number of documento to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of documento, keyed by documento id.
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
            ->from('documento', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
        $statement = $queryBuilder->execute();
        $documentoData = $statement->fetchAll();

        $documento = array();
        foreach ($documentoData as $documentoData) {
            $documentoId = $documentoData['id'];
            $documento[$documentoId] = $this->buildCondominio($documentoData);
        }
        return $documento;
    }
    /**
     * Returns a collection of documento, sorted by name.
     *
     * @return array A collection of documento, keyed by documento id.
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
            ->from('documento', 'a');
            $queryBuilder->setMaxResults($limit);
            $queryBuilder->setFirstResult($offset);
            
            if($like){
                 $queryBuilder->where("a.nome like '%$like%'");
            }
            
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        
        
        $documentoData = $statement->fetchAll();

        $documento = array();
        foreach ($documentoData as $documentoData) {
            $documentoId = $documentoData['id'];
            $documento[$documentoId] = $this->buildCondominio($documentoData);
        }
        return $documento;
    }

    /**
     * Instantiates an documento entity and sets its properties using db data.
     *
     * @param array $documentoData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Condominio
     */
    protected function buildCondominio($documentoData)
    {
        $documento = new Documento();
        $documento->setId($documentoData['id']);
        $documento->setTitulo($documentoData['titulo']);
        $documento->setFile($documentoData['file']);
        $documento->setData($documentoData['data']);
        return $documento;
    }
}
