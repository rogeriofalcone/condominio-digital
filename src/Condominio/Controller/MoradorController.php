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
        $total = $app['repository.reclamacao']->getCountUsuario($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.user']->findAll($limit, $offset,array(),$idu);
        
        $data = array(
            'active'=>'admin_morador',
            'metaDescription' => '',
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
        #$request = $app['request'];
        
        $idnome = $request->get("idnome");
        
        if(is_string($idnome)){
            $oEmp = $app['repository.empreendimento']->findIdNome($idnome);
        }
        if(is_numeric($idnome)){
            $oEmp = $app['repository.empreendimento']->find($idnome);
        }
        
        $reclamacao = new Reclamacao();
        
        if ($request->isMethod('GET')) {
            if (!$oEmp) {
                $message = 'Nenhum empreendimento foi escolhido por favor efetue uma busca e clique nele para adicionar.';
                $app['session']->getFlashBag()->add('warning', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');
                return $app->redirect($redirect);
            }
            /*
             * Pegar id do banco de dados
             */
            $reclamacao->setIde($oEmp->getId());
        }
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
            $reclamacao->setDados($user->getDadosImovel());
        }else{
            $uid = 1;
        }
        
        if (!$user) {
            $message = 'Nenhum usuário logado para efetuar o envio de uma reclamação.';
            $app['session']->getFlashBag()->add('warning', $message);
            $redirect = $app['url_generator']->generate('principal');
            return $app->redirect($redirect);
        }
        
        $reclamacao->setIdu($uid);
        
        $form = $app['form.factory']->create(new ReclamacaoType(), $reclamacao);

        if ($request->isMethod('POST')) {
            
            $form->bind($request);
      
            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                $aImg = $request->get("imgReclamacao");
                
                //$this->imagemRepository
                if(count($aImg)){
                    foreach($aImg as $File){
                            $imagem = new Imagem();
                            $imagem->setFile($File);
                            $imagem->setIdr($reclamacao->getId());
                            $app['repository.imagem']->save($imagem);
                            $app['repository.imagem']->handleFileUpload($File);
                    }
                }
                /*
                * Enviar email
                */
                /*
                * Pegar id da sessao
                */
               if($app['token']){
                   $uid = $app['token']->getUid();
                   $oUser = $app['repository.user']->find($uid);
                   $reclamacao = $app['repository.reclamacao']->find($reclamacao->getId());
                   
                   $body = $app['twig']->render('emailCadastroReclamacao.html.twig',
                            array(
                                'name' => $oUser->getName(),
                                'mail' => $oUser->getEmail(),
                                'idreclamacao'=>str_pad($reclamacao->getId(), 10, "0", STR_PAD_LEFT),
                                'titulo'=>$reclamacao->getTitulo(),
                                'reclamacao'=>$reclamacao
                            ));

                    $message = \Swift_Message::newInstance()
                                    ->setSubject('[Reclame Imóvel] Parabéns reclamação cadastrada com sucesso. ')
                                    ->setFrom(array('contato@reclameimovel.com.br'=>'Reclame Imóvel'))
                                    ->setTo(array($oUser->getEmail()=>$oUser->getName()))
                                    ->setBody($body)
                                    ->setContentType("text/html");

                    $app['mailer']->send($message);   
               }

                    $message = 'Reclamação salva com sucesso.';
                    $app['session']->getFlashBag()->add('success', $message);
                    // Redirect to the edit page.
                    $redirect = $app['url_generator']->generate('view');

                    return $app->redirect($redirect."/".$reclamacao->getIde()."/".$reclamacao->getId());
            }

            return false;
        } else {
            $nome_empresa   = $oEmp->getEmpresa()->getNome();
            $nome_emp       = $oEmp->getNome();
            $bairro         = $oEmp->getBairro();
            
            $sub_titulo     = $nome_empresa. " - " . $nome_emp . " - " . $bairro;

            $data = array(
                'metaDescription' => '',
                'form' => $form->createView(),
                'title' => 'Nova reclamação',
                'sub_titulo' => $sub_titulo,
            );
            return $app['twig']->render('form.html.twig', $data);
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

    public function editAction(Request $request, Application $app) {
        $reclamacao = $request->attributes->get('reclamacao');

        if (!$reclamacao) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }
        $form = $app['form.factory']->create(new ArtistType(), $reclamacao);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                $message = 'The reclamacao ' . $reclamacao->getName() . ' has been saved.';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }

        $data = array(
            'form' => $form->createView(),
            'title' => 'Edit reclamacao ' . $reclamacao->getName(),
        );
        return $app['twig']->render('form.html.twig', $data);
    }

    public function deleteAction(Request $request, Application $app) {
        $reclamacao = $request->attributes->get('reclamacao');
        if (!$reclamacao) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }

        $app['repository.reclamacao']->delete($reclamacao);
        return $app->redirect($app['url_generator']->generate('admin_reclamacaos'));
    }

}
