<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Empreendimento;
use Condominio\Entity\Imagem;
use Condominio\Entity\User;
use Condominio\Form\Type\UserType;
use Condominio\Form\Type\ReclamacaoType;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;


class MoradorController {

    public function indexAction(Request $request, Application $app) {
	$data = array(        
            'active'=>'morador',
            'metaDescription'=>'',
        );
        
        return $app['twig']->render('morador.html.twig',$data);
    }
    public function listarAdminAction(Request $request, Application $app) {
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = $app['repository.user']->getCountMorador($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.user']->findMorador($limit, $offset,array());
        
        $data = array(
            'active'=>'admin_morador',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/admin/morador',
            'here' => "morador",
        );
        
        return $app['twig']->render('admin_morador_listar.html.twig',$data);
    }
    public function listarEmailAdminAction(Request $request, Application $app) {
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = $app['repository.reclamacao']->getCountUsuario($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.user']->findAll($limit, $offset,array(),$idu);
        
        $data = array(
            'active'=>$request->get("_route"),
            'metaDescription' => '',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/admin/morador',
            'here' => "morador",
        );
        
        return $app['twig']->render('admin_morador_email.html.twig',$data);
    }
    public function minhasReclamacoesAction(Request $request, Application $app) {

        if($app['token']){
            $idu = $app['token']->getUid();
        }else{
            $idu = 1;
        }
        
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = $app['repository.reclamacao']->getCountUsuario($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.reclamacao']->findReclamacaoUsuario($limit, $offset,array(),$idu);
        
        $data = array(
            'active'=>'minhas_reclamacoes',
            'metaDescription' => '',
            'active' => 'minhas_reclamacoes',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/empreendimento',
            'here' => "minhas-reclamacoes",
        );

        return $app['twig']->render('minhas_rec.html.twig', $data);
    }
    public function notificacoesAction(Request $request, Application $app) {

        
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = $app['repository.reclamacao']->getCountUsuario($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.reclamacao']->findReclamacaoUsuario($limit, $offset,array(),$idu);
        
        $data = array(
            'active'=>'minhas_reclamacoes',
            'metaDescription' => '',
            'active' => 'minhas_reclamacoes',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/empreendimento',
            'here' => "minhas-reclamacoes",
        );

        return $app['twig']->render('admin_notificacoes.html.twig', $data);
    }
    public function dadosAction(Request $request, Application $app) {
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
        }
        if (!$user) {
            $app->abort(404, 'Erro nenhum usuário encontrado.');
        }

        $user->setIdu($uid);
        
        $form = $app['form.factory']->create(new UserType(), $user);

        $data = array(
            'metaDescription' => '',
            'form' => $form->createView(),
        );
        return $app['twig']->render('mais_dados.html.twig', $data);
      
    }
    public function dadosUpdateAction(Request $request, Application $app) {
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
        }
        if (!$user) {
            $app->abort(404, 'Erro nenhum usuário encontrado.');
        }

        $user->setIdu($uid);
        
        $form = $app['form.factory']->create(new UserType(), $user);

        if ($request->isMethod('POST')) {
            
            $form->bind($request);
      
            if ($form->isValid()) {
                $app['repository.user']->saveAdicional($user);
                
                $message = 'Informações adicionadas com sucesso. Você já esta liberado para reclamar.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');
                
                return $app->redirect($redirect);
            }

            return false;
            
        } 
    }
    public function adicionarAction(Request $request, Application $app) {
                
        $id = $request->get("id");
        
        if ($request->isMethod('POST')) {
            
            $oUser = new User();
            
            $oUser->setId($id);
            $oUser->setMail($request->get("mail"));
            $oUser->setName($request->get("name"));
            $oUser->setPassword($request->get("password"));
            $oUser->setRole("ROLE_MORADOR");
            
            if ($oUser) {
                $app['repository.user']->save($oUser);
          
                $oUser = $app['repository.user']->find($id);
                 
                  /* 
                $body = $app['twig']->render('emailCadastroUsuario.html.twig',
                         array(
                             'name' => $oUser->getName(),
                             'mail' => $oUser->getEmail(),
                         ));

                 $message = \Swift_Message::newInstance()
                                 ->setSubject('[Park Reality] Seja bem vindo. ')
                                 ->setFrom(array('contato@parkreality.com.br'=>'Park Reality'))
                                 ->setTo(array($oUser->getEmail()=>$oUser->getName()))
                                 ->setBody($body)
                                 ->setContentType("text/html");

                 $app['mailer']->send($message);   
               */
                $message = 'Usuário salvo com sucesso.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('admin_morador');

                return $app->redirect($redirect);
            }

            return false;
        } else {
            if($id){
                $oUser = $app['repository.user']->find($id);
                
                if($oUser->getRole() != "ROLE_MORADOR"){
                    
                    $message = 'Usuário não é um morador.';
                    $app['session']->getFlashBag()->add('success', $message);
                    // Redirect to the edit page.
                    $redirect = $app['url_generator']->generate('admin_morador');

                    return $app->redirect($redirect);
                }
            }else{
                $oUser = new User();
            }
            $data = array(
                'user' => $oUser,
                'title' => 'Nova reclamação',
            );
            return $app['twig']->render('admin_morador_adicionar.html.twig', $data);
        }
    }
    public function adicionarFotoAction(Request $request, Application $app) {
        
        // Generate filename
        $filename = md5(mt_rand()).'.jpg';

        // Read RAW data
        $data = file_get_contents('php://input');

        // Read string as an image file
        $image = file_get_contents('data://'.substr($data, 5));

        // Save to disk
        if ( ! file_put_contents(COND_PUBLIC_ROOT .'/tmp_send_image/'.$filename, $image)) {
            header('HTTP/1.1 503 Service Unavailable');
            exit();
        }

        // Clean up memory
        unset($data);
        unset($image);

        // Return file URL
        echo $filename;
        return false;
    }

    public function alterarFotoAction(Request $request, Application $app) {        
        return $app['twig']->render('admin_morador_foto.html.twig');
    }

    public function excluirAction(Request $request, Application $app) {
        $id = $request->attributes->get('id');
        if (!$id) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }

        $app['repository.user']->excluir($id);
        return $app->redirect($app['url_generator']->generate('admin_morador'));
    }

}
