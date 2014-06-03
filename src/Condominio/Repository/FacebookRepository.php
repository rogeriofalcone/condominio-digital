<?php

namespace Condominio\Repository;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphLocation;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookCanvasLoginHelper;

/**
 * User repository
 */
class FacebookRepository
{
    protected $session;
    protected $request;
    protected $token;
    protected $api;
    protected $secret;


    public function __construct($app) {
     
        $this->api      = "237093413164290";
        $this->secret   = "8f94031a4b4a962543c33747c1a2e6e7";

        if($app['token']){
            $this->token = $app['token']->getCredentials();
        }else{
            throw new Exception("Erro ao solicitar usuario ao facebook!");
        }

        // If you already have a valid access token:
        $this->session = new FacebookSession($this->token);
        $this->request = new FacebookRequest($this->session, 'GET', '/me');
       
        
   }
   public function getToken(){
       return $this->token;
   }
   public function checkSession(){
       try {
          return $this->session->validate($this->api,$this->secret);
        } catch (FacebookRequestException $ex) {
          // Sessão não é válido, Graph API retornou uma exceção com a razão.
          echo "Sessao invalida: " . $ex->getMessage();
        } catch (\Exception $ex) {
          // API Graph voltou info, mas pode incompatibilidade do aplicativo atual ou ter expirado.
          echo "mas pode incompatibilidade :" . $ex->getMessage();
        }
   }
   public function getUser(){
       if($this->session) {
            try {
                $response = $this->request->execute();
                return $response->getGraphObject(GraphUser::className());
            } catch(FacebookRequestException $e) {

              echo "Exception occured, code: " . $e->getCode();
              echo " with message: " . $e->getMessage();

            }
        }
   }
   public function getLoc(){
       if($this->session) {
           try {
                return $this->request->execute()->getGraphObject(GraphLocation::className());
           } catch(FacebookRequestException $e) {

              echo "Exception occured, code: " . $e->getCode();
              echo " with message: " . $e->getMessage();

            }
       }
   }
   
   public function graphObject(){
       
       $this->session = new FacebookSession($this->token);
       $response = $this->request->execute();
       $graphObject = $response->getGraphObject();
       return $graphObject;
   }
   
}
