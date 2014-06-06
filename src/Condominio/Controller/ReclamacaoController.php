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


class ReclamacaoController {

   
    public function adicionarAction(Request $request, Application $app) {
 
        $token = $app['security']->getToken();
        $user = $token->getUser();
        
        if ($request->isMethod('GET')) {
            
            if(!$user->getIdcond()){
                $message = 'Desculpe mas não encontrei nenhum condomínio vinculado ao seu usuário, pora favor escolha um condomínio.';
                $app['session']->getFlashBag()->add('warning', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('homeuser');
                return $app->redirect($redirect);
            }
        
            $reclamacao = new Reclamacao();
            $reclamacao->setIdcond($user->getIdcond());
            $reclamacao->setIdu($user->getId());
        }

        
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
            $data = array(
                'metaDescription' => '',
                'form' => $form->createView(),
                'title' => 'Nova reclamação'
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
}
