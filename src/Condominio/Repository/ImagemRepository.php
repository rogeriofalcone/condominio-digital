<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Imagem;

/**
 * Imagem repository
 */
class ImagemRepository implements RepositoryInterface
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
     * Saves the imagem to the database.
     *
     * @param \Condominio\Entity\Imagem $imagem
     */
    public function save($imagem)
    {
        $imagemData = array(
            'id' => $imagem->getId(),
            'idr' => $imagem->getIdr(),
            'file' => $imagem->getFile(),
        );
        
        if ($imagem->getId()) {
            $this->db->update('imagem', $imagemData, array('id' => $imagem->getId()));
        }else {
            $this->db->insert('imagem', $imagemData);             
            $id = $this->db->lastInsertId();
            $imagem->setId($id);
        }
    }
 
    public function handleFileUpload($File) {

        if ($File) {
            if (!copy(COND_PUBLIC_ROOT . '/tmp_send_image/' . $File, COND_PUBLIC_ROOT . '/images/reclamacao/' . $File)) {
                return false;
            }
            unlink(COND_PUBLIC_ROOT . '/tmp_send_image/' . $File);
        }
        return true;
    }
    /**
     * Deletes the imagem.
     *
     * @param \Condominio\Entity\Imagem $imagem
     */
    public function delete($imagem)
    {
        // If the imagem had an image, delete it.
        $image = $imagem->getImage();
        if ($image) {
            unlink('images/imagem/' . $image);
        }
        return $this->db->delete('imagem', array('id' => $imagem->getId()));
    }

    /**
     * Returns the total number of imagem.
     *
     * @return integer The total number of imagem.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM imagem');
    }

    /**
     * Returns an imagem matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Imagem|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $imagemData = $this->db->fetchAssoc('SELECT * FROM imagem WHERE id = ?', array($id));
        return $imagemData ? $this->buildImagem($imagemData) : FALSE;
    }
    /**
     * Returns a collection of imagem, sorted by name.
     *
     * @param integer $limit
     *   The number of imagem to return.
     * @param integer $offset
     *   The number of imagem to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of imagem, keyed by imagem id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('id' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('imagem', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $imagemData = $statement->fetchAll();

        $imagem = array();
        foreach ($imagemData as $imagemData) {
            $imagemId = $imagemData['id'];
            $imagem[$imagemId] = $this->buildImagem($imagemData);
        }
        return $imagem;
    }
    public function findAllByReclamacao($idReclamacao = null,$orderBy = array())
    {
        if(!$idReclamacao){
            return false;
        }
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('id' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('imagem', 'a');
        $queryBuilder->where("idr = $idReclamacao");
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        $imagemData = $statement->fetchAll();

        $imagem = array();
        foreach ($imagemData as $imagemData) {
            $imagemId = $imagemData['id'];
            $imagem[$imagemId] = $this->buildImagem($imagemData);
        }
        return $imagem;
    }

    /**
     * Instantiates an imagem entity and sets its properties using db data.
     *
     * @param array $imagemData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Imagem
     */
    protected function buildImagem($imagemData)
    {
        $imagem = new Imagem();
        $imagem->setId($imagemData['id']);
        $imagem->setIdr($imagemData['idr']);
        $imagem->setFile($imagemData['file']);
        return $imagem;
    }
    
}
