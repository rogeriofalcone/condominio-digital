<?php

namespace Conta\Repository;

use Doctrine\DBAL\Connection;
use Conta\Entity\Pgto;

/**
 * Pgto repository
 */
class PgtoRepository implements RepositoryInterface
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
     * Saves the pgto to the database.
     *
     * @param \Conta\Entity\Pgto $pgto
     */
    public function save($pgto)
    {
        $pgtoData = array(
            'name' => $pgto->getName(),
        );

        if ($pgto->getId()) {
            $this->db->update('pgto', $pgtoData, array('id' => $pgto->getId()));
        }
        else {
            $this->db->insert('pgto', $pgtoData);
            // Get the id of the newly created pgto and set it on the entity.
            $id = $this->db->lastInsertId();
            $pgto->setId($id);
            
        }
    }

    /**
     * Handles the upload of an pgto image.
     *
     * @param \Conta\Entity\Pgto $pgto
     *
     * @param boolean TRUE if a new pgto image was uploaded, FALSE otherwise.
     */
    protected function handleFileUpload($pgto) {
        // If a temporary file is present, move it to the correct directory
        // and set the filename on the pgto.
        $file = $pgto->getFile();
        if ($file) {
            $newFilename = $pgto->getId() . '.' . $file->guessExtension();
            $file->move(Conta_PUBLIC_ROOT . '/img/pgto', $newFilename);
            $pgto->setFile(null);
            $pgto->setImage($newFilename);
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Deletes the pgto.
     *
     * @param \Conta\Entity\Pgto $pgto
     */
    public function delete($pgto)
    {
        // If the pgto had an image, delete it.
        $image = $pgto->getImage();
        if ($image) {
            unlink('images/pgto/' . $image);
        }
        return $this->db->delete('pgto', array('id' => $pgto->getId()));
    }

    /**
     * Returns the total number of pgto.
     *
     * @return integer The total number of pgto.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM pgto');
    }

    /**
     * Returns an pgto matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Conta\Entity\Pgto|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $pgtoData = $this->db->fetchAssoc('SELECT * FROM pgto WHERE id = ?', array($id));
        return $pgtoData ? $this->buildPgto($pgtoData) : FALSE;
    }

    /**
     * Returns a collection of pgto, sorted by name.
     *
     * @param integer $limit
     *   The number of pgto to return.
     * @param integer $offset
     *   The number of pgto to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of pgto, keyed by pgto id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('name' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('pgto', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $pgtoData = $statement->fetchAll();

        $pgto = array();
        foreach ($pgtoData as $pgtoData) {
            $pgtoId = $pgtoData['id'];
            $pgto[$pgtoId] = $this->buildPgto($pgtoData);
        }
        return $pgto;
    }

    /**
     * Instantiates an pgto entity and sets its properties using db data.
     *
     * @param array $pgtoData
     *   The array of db data.
     *
     * @return \Conta\Entity\Pgto
     */
    protected function buildPgto($pgtoData)
    {
        $pgto = new Pgto();
        $pgto->setId($pgtoData['id']);
        $pgto->setName($pgtoData['name']);
        
        return $pgto;
    }
}
