<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Informativo;

/**
 * Condominio repository
 */
class InformativoRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function save($info){
        
         $data = array(
            'idr' => $info->getId(),
            'ide' => $info->getAssunto(),
            'idu' => $info->getIdu(),
            'conteudo' => $info->getConteudo()
        );
         
        if ($info->getId()) {
            $this->db->update('informativo', $data, array('id' => $info->getId()));
            
        }else {
            
            $data['dtenvio'] = date('Y-m-d H:i:s');
            
            $this->db->insert('informativo', $data);             
            $id = $this->db->lastInsertId();
            $info->setId($id);
        }
    }
    public function delete($informativo)
    {
        return $this->db->delete('informativo', array('id' => $informativo->getId()));
    }
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM informativo');
    }
    public function find($id)
    {
        $informativoData = $this->db->fetchAssoc('SELECT * FROM informativo WHERE id = ?', array($id));
        return $informativoData ? $this->buildInformativo($informativoData) : FALSE;
    }
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            //$orderBy = array('' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('informativo', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
        $statement = $queryBuilder->execute();
        $informativoData = $statement->fetchAll();

        $informativo = array();
        foreach ($informativoData as $informativoData) {
            $informativoId = $informativoData['id'];
            $informativo[$informativoId] = $this->buildInformativo($informativoData);
        }
        return $informativo;
    }
    protected function buildInformativo($informativoData)
    {
        $informativo = new Informativo();
        $informativo->setId($informativoData['id']);
        $informativo->setIdu($informativoData['idu']);
        $informativo->setAssunto($informativoData['assunto']);
        $informativo->setDtenvio($informativoData['dtenvio']);
        $informativo->setConteudo($informativoData['conteudo']);
        
        return $informativo;
    }
}
