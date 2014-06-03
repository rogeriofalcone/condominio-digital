<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Empresa;

/**
 * Empresa repository
 */
class EmpresaRepository implements RepositoryInterface
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
     * Saves the empresa to the database.
     *
     * @param \Condominio\Entity\Empresa $empresa
     */
    public function save($empresa)
    {
        $empresaData = array(
            'name' => $empresa->getName(),
            'short_biography' => $empresa->getShortBiography(),
            'biography' => $empresa->getBiography(),
            'soundcloud_url' => $empresa->getSoundCloudUrl(),
            'image' => $empresa->getImage(),
        );

        if ($empresa->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($empresa);
            if ($newFile) {
                $empresaData['image'] = $empresa->getImage();
            }

            $this->db->update('empresa', $empresaData, array('id' => $empresa->getId()));
        }
        else {
            // The empresa is new, note the creation timestamp.
            $empresaData['created_at'] = time();

            $this->db->insert('empresa', $empresaData);
            // Get the id of the newly created empresa and set it on the entity.
            $id = $this->db->lastInsertId();
            $empresa->setId($id);

            // If a new image was uploaded, update the empresa with the new
            // filename.
            $newFile = $this->handleFileUpload($empresa);
            if ($newFile) {
                $newData = array('image' => $empresa->getImage());
                $this->db->update('empresa', $newData, array('id' => $id));
            }
        }
    }

    /**
     * Deletes the empresa.
     *
     * @param \Condominio\Entity\Empresa $empresa
     */
    public function delete($empresa)
    {
        // If the empresa had an image, delete it.
        $image = $empresa->getImage();
        if ($image) {
            unlink('images/empresa/' . $image);
        }
        return $this->db->delete('empresa', array('id' => $empresa->getId()));
    }

    /**
     * Returns the total number of empresa.
     *
     * @return integer The total number of empresa.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM empresa');
    }

    /**
     * Returns an empresa matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Empresa|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $empresaData = $this->db->fetchAssoc('SELECT * FROM empresa WHERE id = ?', array($id));
        return $empresaData ? $this->buildEmpresa($empresaData) : FALSE;
    }
    /**
     * Returns an empresa matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Empresa|false An entity object if found, false otherwise.
     */
    public function findIdNome($id)
    {
        $empresaData = $this->db->fetchAssoc('SELECT * FROM empresa WHERE idnome = ?', array($id));
        return $empresaData ? $this->buildEmpresa($empresaData) : FALSE;
    }

    /**
     * Returns a collection of empresa, sorted by name.
     *
     * @param integer $limit
     *   The number of empresa to return.
     * @param integer $offset
     *   The number of empresa to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of empresa, keyed by empresa id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('empresa', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $empresaData = $statement->fetchAll();

        $empresa = array();
        foreach ($empresaData as $empresaData) {
            $empresaId = $empresaData['id'];
            $empresa[$empresaId] = $this->buildEmpresa($empresaData);
        }
        return $empresa;
    }

    /**
     * Instantiates an empresa entity and sets its properties using db data.
     *
     * @param array $empresaData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Empresa
     */
    protected function buildEmpresa($empresaData)
    {
        $empresa = new Empresa();
        $empresa->setId($empresaData['id']);
        $empresa->setNome($empresaData['nome']);
        $empresa->setLogin($empresaData['login']);
        $empresa->setSenha($empresaData['senha']);
        $empresa->setUf($empresaData['uf']);
        $empresa->setCidade($empresaData['cidade']);
        return $empresa;
    }
    
}
