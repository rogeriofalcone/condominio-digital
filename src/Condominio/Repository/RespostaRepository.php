<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Resposta;
/**
 * Reclamacao repository
 */
class RespostaRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    /**
     * @var \Condominio\Repository\EmpreendimentoRepository
     */
    protected $empreendimentoRepository;
    protected $usuarioRepository;

    public function __construct(Connection $db,$empreendimentoRepository,$usuarioRepository)
    {
        $this->db = $db;
        $this->empreendimentoRepository = $empreendimentoRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Saves the resposta to the database.
     *
     * @param \Condominio\Entity\Reclamacao $resposta
     */
    public function save($resposta)
    {
        $respostaData = array(
            'idr' => $resposta->getIdr(),
            'ide' => $resposta->getIde(),
            'iduser' => $resposta->getIduser(),
            'resposta' => $resposta->getResposta(),
            'dtResposta' => date('Y-m-d H:i:s'),
        );

        if ($resposta->getId()) {
            $this->db->update('resposta', $respostaData, array('id' => $resposta->getId()));
        }else {
            $this->db->insert('resposta', $respostaData);             
            $id = $this->db->lastInsertId();
            $resposta->setId($id);
        }
    }
  
    public function updateVisita($id)
    {
        $oRec = $this->find($id);
        $visita = $oRec->getVisita() + 1;
        
        $this->db->update('resposta', array('visita'=>$visita), array('id' => $id));
    }
    /**
     * Deletes the resposta.
     *
     * @param \Condominio\Entity\Reclamacao $resposta
     */
    public function delete($resposta)
    {
        // If the resposta had an image, delete it.
        $image = $resposta->getImage();
        if ($image) {
            unlink('images/resposta/' . $image);
        }
        return $this->db->delete('resposta', array('id' => $resposta->getId()));
    }

    /**
     * Returns the total number of resposta.
     *
     * @return integer The total number of resposta.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM resposta');
    }

    /**
     * Returns the total number of resposta.
     *
     * @return integer The total number of resposta.
     */
    public function getCountSolucao($ide) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM resposta where ide = '$ide' and solucao=1");
    }
    public function getCountUsuario($idu) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM resposta where idu = '$idu'");
    }
    public function getCountReclamacao($ide) {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM resposta where ide = '$ide' ");
    }

    /**
     * Returns an resposta matching the supplied id.
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
            ->from('resposta', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide")
            ->where("r.id = $id");
          
        $statement = $queryBuilder->execute();
        $respostaData = $statement->fetch();

        return $respostaData ? $this->buildReclamacao($respostaData) : FALSE;
        
        
    }

    /**
     * Returns a collection of resposta, sorted by name.
     *
     * @param integer $limit
     *   The number of resposta to return.
     * @param integer $offset
     *   The number of resposta to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of resposta, keyed by resposta id.
     */
    public function findAll($idr=false, $limit=10, $offset = 0, $orderBy = array())
    {      
        if(empty($idr)){
            return false;
        }
        
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('rs.dtResposta' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('rs.id,rs.idr,rs.ide,rs.iduser,rs.dtResposta,rs.avaliacao,rs.resposta')
            ->from('resposta', 'rs');
        
        $queryBuilder->where("rs.idr = $idr");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        $respostaData = $statement->fetchAll();

        $resposta = array();
        foreach ($respostaData as $respostaData) {
            $respostaId = $respostaData['id'];
            $resposta[$respostaId] = $this->buildResposta($respostaData);
        }
        
        return $resposta;
    }
    /**
     * Returns a collection of resposta, sorted by name.
     *
     * @return array A collection of resposta, keyed by resposta id.
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
            ->from('resposta', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
        
        if($ide){
            $queryBuilder->where("r.ide = $ide");
        }
        
        $statement = $queryBuilder->execute();
        $respostaData = $statement->fetchAll();

        $resposta = array();
        foreach ($respostaData as $respostaData) {
            $respostaId = $respostaData['id'];
            $resposta[$respostaId] = $this->buildReclamacao($respostaData);
        }
        
        return $resposta;
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
            ->from('resposta', 'r')
            ->innerJoin('r',"empreendimento","emp","emp.id = r.ide")
            ->innerJoin('emp',"empresa","e","e.id = emp.ide");
        
        $queryBuilder->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy( key($orderBy), current($orderBy));
        
        if($idu){
            $queryBuilder->where("r.idu = $idu");
        }
        
        $statement = $queryBuilder->execute();
        $respostaData = $statement->fetchAll();

        $resposta = array();
        foreach ($respostaData as $respostaData) {
            $respostaId = $respostaData['id'];
            $resposta[$respostaId] = $this->buildReclamacao($respostaData);
        }
        
        return $resposta;
    }

    /**
     * Instantiates an resposta entity and sets its properties using db data.
     *
     * @param array $respostaData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Reclamacao
     */
    protected function buildResposta($respostaData)
    {
        $empreendimento     = $this->empreendimentoRepository->find($respostaData['ide']);
        $collectionUsuario  = $this->usuarioRepository->find($respostaData['iduser']);
 
        $resposta = new Resposta();
        $resposta->setId($respostaData['id']);
        $resposta->setIdr($respostaData['idr']);
        $resposta->setIde($respostaData['ide']);
        $resposta->setIduser($respostaData['iduser']);
        $resposta->setDtResposta($respostaData['dtResposta']);
        $resposta->setAvaliacao($respostaData['avaliacao']);
        $resposta->setResposta($respostaData['resposta']);

        $resposta->setEmpreendimento($empreendimento);
        $resposta->setUser($collectionUsuario);
   
        return $resposta;
    }
}
