<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Condominio;
use Condominio\Entity\Imagem;
use Condominio\Entity\User;
use Condominio\Form\Type\UserType;
use Condominio\Form\Type\ReclamacaoType;


class ReclamacaoController {

   public function minhasReclamacoesAction(Request $request, Application $app) {

        $token = $app['security']->getToken();
        $user = $token->getUser();
        $idu    =   $user->getId();
        
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
            'uri'=>'/admin/reclamacao',
            'here' => "minhas-reclamacoes",
        );

        return $app['twig']->render('minhas_rec.html.twig', $data);
    }
   public function todasReclamacoesAction(Request $request, Application $app) {

        $token = $app['security']->getToken();
        $user = $token->getUser();
        $idu    =   $user->getId();
        
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = $app['repository.reclamacao']->getCount();
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.reclamacao']->findAll($limit, $offset,array(),$idu);
        
        $data = array(
            'active'=>'minhas_reclamacoes',
            'metaDescription' => '',
            'active' => 'minhas_reclamacoes',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/admin/reclamacao',
            'here' => "minhas-reclamacoes",
        );

        return $app['twig']->render('reclamacoes.html.twig', $data);
    }
    public function adicionarAction(Request $request, Application $app) {
 
        $token = $app['security']->getToken();
        $user = $token->getUser();
        
        $reclamacao = new Reclamacao();
        $reclamacao->setIdu($user->getId());
        $reclamacao->setIdcond($user->getIdcond());
        
        if ($request->isMethod('GET')) {
            if(!$user->getIdcond()){
                $message = 'Desculpe mas não encontrei nenhum condomínio vinculado ao seu usuário, pora favor escolha um condomínio.';
                $app['session']->getFlashBag()->add('warning', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('homeuser');
                return $app->redirect($redirect);
            }
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
               if($user){
                   
                   $oUser       = $app['repository.user']->find($user->getId());
                   
                   $body = $app['twig']->render('emailCadastroReclamacao.html.twig',
                    array(
                        'name' => $user->getName(),
                        'mail' => $user->getMail(),
                        'idreclamacao'=>str_pad($reclamacao->getId(), 10, "0", STR_PAD_LEFT),
                        'titulo'=>$reclamacao->getTitulo(),
                        'reclamacao'=>$reclamacao
                    ));

                   /* $message = \Swift_Message::newInstance()
                                    ->setSubject('[Reclame Imóvel] Parabéns reclamação cadastrada com sucesso. ')
                                    ->setFrom(array('contato@reclameimovel.com.br'=>'Reclame Imóvel'))
                                    ->setTo(array($user->getMail()=>$user->getName()))
                                    ->setBody($body)
                                    ->setContentType("text/html");
                                    */
                    //$app['mailer']->send($message);   
                    
                    $message = 'Reclamação salva com sucesso.';
                    $app['session']->getFlashBag()->add('success', $message);
                    // Redirect to the edit page.
                    $redirect = $app['url_generator']->generate('view');
                    return $app->redirect($redirect."/".$reclamacao->getId());
               }
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
    
    public function viewAction(Request $request, Application $app) {
        
        $id = $request->get("id");

        $oReclamacao = $app['repository.reclamacao']->find($id);

        if ($oReclamacao) {
            
                $oCondominio = $app['repository.condominio']->find($oReclamacao->getIdcond());

                $app['repository.reclamacao']->updateVisita($id);

                $titulo = ucwords($oCondominio->getNome());
                $descricao = $oReclamacao->getDescricao();
                $titulo_reclamacao = $oReclamacao->getTitulo();
                $imagem = $oReclamacao->getImagem();

                $aYoutube = explode("=",$oReclamacao->getYoutube());
                
                //$oResposta = $app['repository.resposta']->findAll($id);
       
                $data = array(
                    'resposta'              => $oResposta,
                    'youtube'               => $aYoutube[1],
                    'descricao'             => $descricao,
                    'nome_empresa'          => $nome_empresa,
                    'reclamacao'            => $oReclamacao,
                    'titulo_empreendimento' => $titulo,
                    'id'                    => $id,
                    'imagem'                => $imagem,
                );
                
                return $app['twig']->render('view.html.twig', $data);
                
        } else {
            return $app->redirect("/admin/reclamacao");
        }        
    }
}
