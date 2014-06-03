<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Reclamacao;
/**
 * Reclamacao repository
 */
class ReclamacaoRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    /**
     * @var \Condominio\Repository\EmpreendimentoRepository
     */
    protected $empreendimentoRepository;
    protected $imagemRepository;
    protected $userRepository;

    public function __construct(Connection $db,$empreendimentoRepository,$imagemRepository,$userRepository)
    {
        $this->db = $db;
        $this->empreendimentoRepository = $empreendimentoRepository;
        $this->imagemRepository = $imagemRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Saves the reclamacao to the database.
     *
     * @param \Condominio\Entity\Reclamacao $reclamacao
     */
    public function save($reclamacao)
    {
        $reclamacaoData = array(
            'idu' => $reclamacao->getIdu(),
            'ide' => $reclamacao->getIde(),
            'titulo' => $reclamacao->getTitulo(),
            'dados' => $reclamacao->getDados(),
            'idassunto' => $reclamacao->getIdassunto(),
            'descricao' => $reclamacao->getDescricao(),
            'youtube' => $reclamacao->getYoutube(),
            'dt_cadastro'=>date('Y-m-d H:i:s')
        );

        if ($reclamacao->getId()) {
            $this->db->update('reclamacao', $reclamacaoData, array('id' => $reclamacao->getId()));
        }else {
            $this->db->insert('reclamacao', $reclamacaoData);             
            $id = $this->db->lastInsertId();
            $reclamacao->setId($id);
        }
    }
  
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('reclamacao', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Deletes the reclamacao.
     *
     * @param \Condominio\Entity\Reclamacao $reclamacao
     */
    public function delete($reclamacao)
    {
        // If the reclamacao had an image, delete it.
        $image = $reclamacao->getImage();
        if ($image) {
            unlink('images/reclamacao/' . $image);
        }
        return $this->db->delete('reclamacao', array('id' => $reclamacao->getId()));
    }

    /**
     * Returns the total number of reclamacao.
     *
     * @return integer The total number of reclamacao.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM reclamacao');
    }

    /**
     * Returns the total number of reclamacao.
     *
     * @return integer The total number of reclamacao.
     */
    public function getCountSolucao($ide) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM reclamacao where ide = '$ide' and solucao=1");
    }
    public function getCountUsuario($idu) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM reclamacao where idu = '$idu'");
    }
    public function getCountReclamacao($ide) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM reclamacao where ide = '$ide' ");
    }

    /**
     * Returns an reclamacao matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Reclamacao|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        if($id == ""){
            return false; 
        }
        
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('r.id,r.idu,r.ide,r.titulo,r.descricao,r.idassunto,r.dados,r.dt_cadastro,r.visita,r.youtube,emp.cidade,emp.uf,e.nome as nome')
            ->from('reclamacao', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide")
            ->where("r.id = $id");
          
        $statement = $queryBuilder->execute();
        $reclamacaoData = $statement->fetch();

        return $reclamacaoData ? $this->buildReclamacao($reclamacaoData) : FALSE;
        
        
    }

    /**
     * Returns a collection of reclamacao, sorted by name.
     *
     * @param integer $limit
     *   The number of reclamacao to return.
     * @param integer $offset
     *   The number of reclamacao to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of reclamacao, keyed by reclamacao id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('r.dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('r.id,r.idu,r.ide,r.titulo,r.descricao,r.idassunto,r.dados,r.dt_cadastro,r.visita,r.youtube,emp.idnome,emp.cidade,emp.uf,e.nome as nome')
            ->from('reclamacao', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
          
        $statement = $queryBuilder->execute();
        $reclamacaoData = $statement->fetchAll();

        $reclamacao = array();
        foreach ($reclamacaoData as $reclamacaoData) {
            $reclamacaoId = $reclamacaoData['id'];
            $reclamacao[$reclamacaoId] = $this->buildReclamacao($reclamacaoData);
        }
        
        return $reclamacao;
    }
    /**
     * Returns a collection of reclamacao, sorted by name.
     *
     * @return array A collection of reclamacao, keyed by reclamacao id.
     */
    public function findReclamacaoEmpreendimento($limit, $offset = 0, $orderBy = array(),$ide=null)
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('r.dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('r.id,r.idu,r.ide,r.titulo,r.descricao,r.idassunto,r.dados,r.dt_cadastro,r.visita,r.youtube,emp.idnome,emp.cidade,emp.uf,e.nome as nome')
            ->from('reclamacao', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
        
        if($ide){
            $queryBuilder->where("r.ide = $ide");
        }
        
        $statement = $queryBuilder->execute();
        $reclamacaoData = $statement->fetchAll();

        $reclamacao = array();
        foreach ($reclamacaoData as $reclamacaoData) {
            $reclamacaoId = $reclamacaoData['id'];
            $reclamacao[$reclamacaoId] = $this->buildReclamacao($reclamacaoData);
        }
        
        return $reclamacao;
    }
    public function findReclamacaoUsuario($limit, $offset = 0, $orderBy = array(),$idu=null)
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('r.dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('r.id,r.idu,r.ide,r.titulo,r.descricao,r.idassunto,r.dados,r.dt_cadastro,r.visita,r.youtube,emp.idnome,emp.cidade,emp.uf,e.nome as nome')
            ->from('reclamacao', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
        
        if($idu){
            $queryBuilder->where("r.idu = $idu");
        }
        
        $statement = $queryBuilder->execute();
        $reclamacaoData = $statement->fetchAll();

        $reclamacao = array();
        foreach ($reclamacaoData as $reclamacaoData) {
            $reclamacaoId = $reclamacaoData['id'];
            $reclamacao[$reclamacaoId] = $this->buildReclamacao($reclamacaoData);
        }
        
        return $reclamacao;
    }

    /**
     * Instantiates an reclamacao entity and sets its properties using db data.
     *
     * @param array $reclamacaoData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Reclamacao
     */
    protected function buildReclamacao($reclamacaoData)
    {
        $empreendimento     = $this->empreendimentoRepository->find($reclamacaoData['ide']);
        $collectionImagem   = $this->imagemRepository->findAllByReclamacao($reclamacaoData['id']);
        $collectionUser     = $this->userRepository->find($reclamacaoData['idu']);
        
        $reclamacao = new Reclamacao();
        $reclamacao->setId($reclamacaoData['id']);
        $reclamacao->setIdu($reclamacaoData['idu']);
        $reclamacao->setIde($reclamacaoData['ide']);
        $reclamacao->setVisita($reclamacaoData['visita']);        
        $reclamacao->setTitulo($reclamacaoData['titulo']);
        $reclamacao->setDescricao($reclamacaoData['descricao']);
        $reclamacao->setDados($reclamacaoData['dados']);
        $reclamacao->setIdassunto($reclamacaoData['idassunto']);
        $reclamacao->setYoutube($reclamacaoData['youtube']);
        
        $createdAt = new \DateTime($reclamacaoData['dt_cadastro']);        
        $reclamacao->setDt_cadastro($createdAt);
        
        $reclamacao->setEmpreendimento($empreendimento);
        $reclamacao->setImagem($collectionImagem);
        $reclamacao->setUser($collectionUser);
        return $reclamacao;
    }
}
