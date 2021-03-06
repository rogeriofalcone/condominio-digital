<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * User repository
 */
class UserRepository implements RepositoryInterface, UserProviderInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder
     */
    protected $encoder;

    public function __construct(Connection $db, $encoder)
    {
        $this->db = $db;
        $this->encoder = $encoder;
    }

    /**
     * Saves the user to the database.
     *
     * @param \Conta\Entity\User $user
     */
    public function save($user)
    {
        
       
        $userData = array(
            'username' => $user->getUsername(),
            'name' => $user->getName(),
            'mail' => $user->getMail(),
            'role' => $user->getRole(),
        );
        
        // If the password was changed, re-encrypt it.
        if (strlen($user->getPassword()) != 88 && strlen($user->getPassword()) > 0) {
            $userData['salt'] = uniqid(mt_rand());
            $userData['password'] = $this->encoder->encodePassword($user->getPassword(), $userData['salt']);
        }
        
        if ($user->getId()) {         
            $this->db->update('users', $userData, array('id' => $user->getId()));
        } else {
            // The user is new, note the creation timestamp.
            $userData['created_at'] = time();

            $this->db->insert('users', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->db->lastInsertId();
            $user->setId($id);         
        }
    }

    /**
     * Handles the upload of a user image.
     *
     * @param \Conta\Entity\User $user
     *
     * @param boolean TRUE if a new user image was uploaded, FALSE otherwise.
     */
    protected function handleFileUpload($user) {
        // If a temporary file is present, move it to the correct directory
        // and set the filename on the user.
        $file = $user->getFile();
        if ($file) {
            $newFilename = $user->getUsername() . '.' . $file->guessExtension();
            $file->move(Conta_PUBLIC_ROOT . '/img/users', $newFilename);
            $user->setFile(null);
            $user->setImage($newFilename);
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Deletes the user.
     *
     * @param integer $id
     */
    public function delete($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }
    public function excluir($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }

    /**
     * Returns the total number of users.
     *
     * @return integer The total number of users.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM users');
    }
    public function getCountMorador() {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM users where role = 'ROLE_MORADOR'");
    }
    public function getCountAdministracao() {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM users where role <> 'ROLE_MORADOR'");
    }
    

    public function find($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM users WHERE id = ?', array($id));
        return $userData ? $this->buildUser($userData) : FALSE;
    }

    /**
     * Returns a collection of users.
     *
     * @param integer $limit
     *   The number of users to return.
     * @param integer $offset
     *   The number of users to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of users, keyed by user id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('username' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();

        $users = array();
        foreach ($usersData as $userData) {
            $userId = $userData['id'];
            $users[$userId] = $this->buildUser($userData);
        }

        return $users;
    }
    public function findMorador($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('username' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $queryBuilder->where('u.role = :role')->setParameter('role', "ROLE_MORADOR");
        
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();

        $users = array();
        foreach ($usersData as $userData) {
            $userId = $userData['id'];
            $users[$userId] = $this->buildUser($userData);
        }

        return $users;
    }
    public function findAdministracao($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('username' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $queryBuilder->where('u.role <> :role')->setParameter('role', "ROLE_MORADOR");
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        
        $users = array();
        foreach ($usersData as $userData) {
            $userId = $userData['id'];
            $users[$userId] = $this->buildUser($userData);
        }

        return $users;
    }
    public function findSindico($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('username' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $queryBuilder->where("u.role in('ROLE_ADMIN','ROLE_SUBSINDICO')");
        
        $statement = $queryBuilder->execute();
        
        $usersData = $statement->fetchAll();
        
        $users = array();
        foreach ($usersData as $userData) {
            $userId = $userData['id'];
            $users[$userId] = $this->buildUser($userData);
        }

        return $users;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('u.username = :username OR u.mail = :mail')
            ->setParameter('username', $username)
            ->setParameter('mail', $username)
            ->setMaxResults(1);
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        if (empty($usersData)) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        $user = $this->buildUser($usersData[0]);
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        $id = $user->getId();
        $refreshedUser = $this->find($id);
        if (false === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id)));
        }

        return $refreshedUser;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Condominio\Entity\User' === $class;
    }

    public function getTipo($role=""){
        $aTipo['ROLE_ADMIN'] = "Síndico";
        $aTipo['ROLE_SUBSINDICO'] = "Sub Síndico";
        $aTipo['ROLE_MORADOR'] = "Morador";
        $aTipo['ROLE_ADMINISTRATIVO'] = "Administrativo";
        if($role){
            return $aTipo[$role];
        }
    }

    /**
     * Instantiates a user entity and sets its properties using db data.
     *
     * @param array $userData
     *   The array of db data.
     *
     * @return \Conta\Entity\User
     */
    protected function buildUser($userData)
    {
        $user = new User();
        $user->setId($userData['id']);
        $user->setUsername($userData['username']);
        $user->setSalt($userData['salt']);
        $user->setPassword($userData['password']);
        $user->setMail($userData['mail']);
        $user->setRole($userData['role']);
        $user->setIdcond($userData['idcond']);
        $user->setName($userData['name']);
        $user->setBloco($userData['bloco']);
        $user->setAp($userData['ap']);
        $user->setTel($userData['tel']);
        $user->setCel($userData['cel']);
        $user->setComp($userData['comp']);
        $user->setNoTipo($this->getTipo($userData['role']));
        $createdAt = new \DateTime('@' . $userData['created_at']);
        $user->setCreatedAt($createdAt);
        return $user;
    }
}
