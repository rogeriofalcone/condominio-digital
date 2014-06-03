<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Empreendimento;

/**
 * Empreendimento repository
 */
class EmpreendimentoRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    protected $empresaRepository;

    public function __construct(Connection $db, $empresaRepository)
    {
        $this->db = $db;
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * Saves the empreendimento to the database.
     *
     * @param \Condominio\Entity\Empreendimento $empreendimento
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
            $this->db->update('tmp_empreendimento', $empData, array('id' => $emp->getId()));
        }else {
            $this->db->insert('tmp_empreendimento', $empData);             
            $id = $this->db->lastInsertId();
            $emp->setId($id);
        }
    }

    /**
     * Deletes the empreendimento.
     *
     * @param \Condominio\Entity\Empreendimento $empreendimento
     */
    public function delete($empreendimento)
    {
        // If the empreendimento had an image, delete it.
        $image = $empreendimento->getImage();
        if ($image) {
            unlink('images/empreendimento/' . $image);
        }
        return $this->db->delete('empreendimento', array('id' => $empreendimento->getId()));
    }

    /**
     * Returns the total number of empreendimento.
     *
     * @return integer The total number of empreendimento.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM empreendimento');
    }
    public function getCountBusca($busca) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM empreendimento where nome like '%$busca%'");
    }
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('empreendimento', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Returns an empreendimento matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Empreendimento|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $empreendimentoData = $this->db->fetchAssoc('SELECT * FROM empreendimento WHERE id = ?', array($id));
        return $empreendimentoData ? $this->buildEmpreendimento($empreendimentoData) : FALSE;
    }
    /**
     * Returns an empreendimento matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Empreendimento|false An entity object if found, false otherwise.
     */
    public function findIdNome($id)
    {
        $empreendimentoData = $this->db->fetchAssoc('SELECT * FROM empreendimento WHERE idnome = ?', array($id));
        return $empreendimentoData ? $this->buildEmpreendimento($empreendimentoData) : FALSE;
    }

    /**
     * Returns a collection of empreendimento, sorted by name.
     *
     * @param integer $limit
     *   The number of empreendimento to return.
     * @param integer $offset
     *   The number of empreendimento to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of empreendimento, keyed by empreendimento id.
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
            ->from('empreendimento', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $empreendimentoData = $statement->fetchAll();

        $empreendimento = array();
        foreach ($empreendimentoData as $empreendimentoData) {
            $empreendimentoId = $empreendimentoData['id'];
            $empreendimento[$empreendimentoId] = $this->buildEmpreendimento($empreendimentoData);
        }
        return $empreendimento;
    }
    /**
     * Returns a collection of empreendimento, sorted by name.
     *
     * @return array A collection of empreendimento, keyed by empreendimento id.
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
            ->from('empreendimento', 'a');
            $queryBuilder->setMaxResults($limit);
            $queryBuilder->setFirstResult($offset);
            
            if($like){
                 $queryBuilder->where("a.nome like '%$like%'");
            }
            
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        
        
        $empreendimentoData = $statement->fetchAll();

        $empreendimento = array();
        foreach ($empreendimentoData as $empreendimentoData) {
            $empreendimentoId = $empreendimentoData['id'];
            $empreendimento[$empreendimentoId] = $this->buildEmpreendimento($empreendimentoData);
        }
        return $empreendimento;
    }

    /**
     * Instantiates an empreendimento entity and sets its properties using db data.
     *
     * @param array $empreendimentoData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Empreendimento
     */
    protected function buildEmpreendimento($empreendimentoData)
    {
        
        $empresa = $this->empresaRepository->find($empreendimentoData['ide']);
         
        $empreendimento = new Empreendimento();
        $empreendimento->setEmpresa($empresa);
        $empreendimento->setId($empreendimentoData['id']);
        $empreendimento->setIdnome($empreendimentoData['idnome']);
        $empreendimento->setIde($empreendimentoData['ide']);
        $empreendimento->setNome(utf8_encode($empreendimentoData['nome']));
        $empreendimento->setBairro($empreendimentoData['bairro']);
        $empreendimento->setCidade($empreendimentoData['cidade']);
        $empreendimento->setUf($empreendimentoData['uf']);
        $empreendimento->setVisita($empreendimentoData['visita']);
        return $empreendimento;
    }
}
