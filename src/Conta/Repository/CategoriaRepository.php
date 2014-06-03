<?php

namespace Conta\Repository;

use Doctrine\DBAL\Connection;
use Conta\Entity\Categoria;

/**
 * Categoria repository
 */
class CategoriaRepository implements RepositoryInterface
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
     * Saves the artist to the database.
     *
     * @param \Conta\Entity\Categoria $categoria
     */
    public function save($categoria)
    {
        $artistData = array(
            'name' => $artist->getName(),
            'short_biography' => $artist->getShortBiography(),
            'biography' => $artist->getBiography(),
            'soundcloud_url' => $artist->getSoundCloudUrl(),
            'image' => $artist->getImage(),
        );

        if ($artist->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($artist);
            if ($newFile) {
                $artistData['image'] = $artist->getImage();
            }

            $this->db->update('categorias', $artistData, array('artist_id' => $artist->getId()));
        }
        else {
            // The artist is new, note the creation timestamp.
            $artistData['created_at'] = time();

            $this->db->insert('categorias', $artistData);
            // Get the id of the newly created artist and set it on the entity.
            $id = $this->db->lastInsertId();
            $artist->setId($id);

            // If a new image was uploaded, update the artist with the new
            // filename.
            $newFile = $this->handleFileUpload($artist);
            if ($newFile) {
                $newData = array('image' => $artist->getImage());
                $this->db->update('categorias', $newData, array('artist_id' => $id));
            }
        }
    }
    /**
     * Deletes the categoria.
     *
     * @param \Conta\Entity\Categoria $categoria
     */
    public function delete($artist)
    {
        // If the artist had an image, delete it.
        $image = $artist->getImage();
        if ($image) {
            unlink('images/categorias/' . $image);
        }
        return $this->db->delete('categoria', array('id' => $artist->getId()));
    }

    /**
     * Returns the total number of categorias.
     *
     * @return integer The total number of categorias.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM categoria');
    }

    /**
     * Returns an artist matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Conta\Entity\Artist|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $artistData = $this->db->fetchAssoc('SELECT * FROM categoria WHERE id = ?', array($id));
        return $artistData ? $this->buildArtist($artistData) : FALSE;
    }

    /**
     * Returns a collection of categorias, sorted by name.
     *
     * @param integer $limit
     *   The number of categorias to return.
     * @param integer $offset
     *   The number of categorias to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of categoria, keyed by categoria id.
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
            ->from('categoria', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $categoriasData = $statement->fetchAll();

        $categorias = array();
        foreach ($categoriasData as $artistData) {
            $artistId = $artistData['id'];
            $categorias[$artistId] = $this->buildArtist($artistData);
        }
        return $categorias;
    }

    /**
     * Instantiates an categoria entity and sets its properties using db data.
     *
     * @param array $artistData
     *   The array of db data.
     *
     * @return \Conta\Entity\Categoria
     */
    protected function buildArtist($artistData)
    {
        $artist = new Categoria();
        $artist->setId($artistData['id']);
        $artist->setName($artistData['nome']);
        return $artist;
    }
}
