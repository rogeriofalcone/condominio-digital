<?php


namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Gigablah\Silex\OAuth\OAuthServiceRegistry;
use Gigablah\Silex\OAuth\OAuthEvents;
use Gigablah\Silex\OAuth\Event\FilterTokenEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/** Condominio
 * Listener to retrieve user information from the OAuth service provider.
 *
 * @author Chris Heng <bigblah@gmail.com>
 */
class UserInfoListener implements EventSubscriberInterface
{
    private $registry;
    private $config;
    private $db;

    /**
     * Constructor.
     *
     * @param OAuthServiceRegistry $registry
     * @param array                $config
     */
    public function __construct(OAuthServiceRegistry $registry, array $config = array(),Connection $db)
    {
        $this->registry = $registry;
        $this->config = $config;
        $this->db = $db;
    }

    /**
     * When the security token is created, populate it with user information from the service API.
     *
     * @param FilterTokenEvent $event
     */
    public function onFilterToken(FilterTokenEvent $event)
    {
        $token = $event->getToken();
        $service = $token->getService();
        $oauthService = $this->registry->getService($service);
        $accessToken = $oauthService->getStorage()->retrieveAccessToken(OAuthServiceRegistry::getServiceName($oauthService));
        $token->setAccessToken($accessToken);

        if (false === $rawUserInfo = json_decode($oauthService->request($this->config[$service]['user_endpoint']), true)) {
            return;
        }

        $userInfo = array();
        $fieldMap = array(
            'id' => array('id'),
            'name' => array('name', 'username', 'screen_name'),
            'email' => array('email', function ($data, $provider) {
                if ('twitter' === $provider) {
                    return $data['screen_name'] . '@twitter.com';
                }
            })
        );

        foreach ($fieldMap as $key => $fields) {
            $userInfo[$key] = null;
            foreach ($fields as $field) {
                if (is_callable($field)) {
                    $userInfo[$key] = $field($rawUserInfo, $service);
                    break;
                }
                if (isset($rawUserInfo[$field])) {
                    $userInfo[$key] = $rawUserInfo[$field];
                    break;
                }
            }
        }

        $token->setUser($userInfo['name']);
        $token->setEmail($userInfo['email']);
        $token->setUid($userInfo['id']);
        
        $userData['dt_last_login'] = date('Y-m-d H:i:s');
        
        $aData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE idu = ?', array($userInfo['id']));
        
        if($aData){
            $this->db->update('usuario', $userData, array('idu' => $aData['id']));
        }else{            
            $userData['dt_cadastro'] = date('Y-m-d H:i:s');
            $userData['idu'] = $userInfo['id'];
            $userData['email'] = $userInfo['email'];        
            $userData['name'] = $userInfo['name'];        
            $userData['role'] = "ROLE_USER";
            $this->db->insert('usuario', $userData);            
        }
        
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            OAuthEvents::TOKEN => 'onFilterToken'
        );
    }
}
