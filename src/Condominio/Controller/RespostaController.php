<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Empreendimento;
use Condominio\Entity\Resposta;
use Condominio\Form\Type\RespostaType;



class RespostaController {

    public function adicionarAction(Request $request, Application $app) {
        #$request = $app['request'];
        
        $idr = $request->get("idr");
     
        $resposta = new Resposta();
        
        if ($request->isMethod('GET')) {
            
            if ($idr) {
               $oReclamacao = $app['repository.reclamacao']->find($idr);
               
                #$message = 'Nenhuma reclamação foi encontrada.';
               # $app['session']->getFlashBag()->add('warning', $message);
                // Redirect to the edit page.
                #$redirect = $app['url_generator']->generate('admin_morador');
                #return $app->redirect($redirect);
               
               $resposta->setIde($oReclamacao->getIde());
               $resposta->setIduser(1);
               $resposta->setIdr($idr);
            }
            /*
             * Pegar id do banco de dados
             */
            
        }
        
        
        $form = $app['form.factory']->create(new RespostaType(), $resposta);

        if ($request->isMethod('POST')) {
            
            $form->bind($request);
      
            if ($form->isValid()) {
                $app['repository.resposta']->save($resposta);
                
                /*
                * Pegar id da sessao
                */
               //if(){
                   /*$uid = $app['token']->getUid();
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

                    $app['mailer']->send($message);   */
               //}

                $message = 'Reclamação salva com sucesso.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('admin_resposta_adicionar');

                return $app->redirect($redirect."/".$resposta->getIdr());
            }

            return false;
        } else {
  
            $data = array(
                'metaDescription' => '',
                'form' => $form->createView(),
                'title' => 'Nova reclamação',
                'sub_titulo' => $sub_titulo,
            );
            return $app['twig']->render('resposta.html.twig', $data);
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
