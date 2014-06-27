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


class InformativoController {

    public function indexAction(Request $request, Application $app) {
        $page = $request->get("page", 1);
        
        $limit = 10;
        $total = 0;//$app['repository.user']->getCountSindico($idu);
        
        $numPages = ceil($total / $limit);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.informativo']->findAll($limit, $offset,array());
        
        $data = array(
            'active'=>'listar-documento',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'adjacentes' => 2,
            'busca'=>false,
            'uri'=>'/admin/morador',
            'here' => "morador",
        );
        
        return $app['twig']->render('admin_informativo_listar.html.twig',$data);
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
                $app['repository.informativo']->save($oUser);
          
                $message = 'Informativo salvo com sucesso.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('listar-informativo');

                return $app->redirect($redirect);
            }

            return false;
        } else {
            if($id){
                $oInformativo = $app['repository.informativo']->find($id);                
            }else{
                $oInformativo = new Informativo();
            }
            $data = array(
                'user' => $oInformativo,
                'title' => 'Novo Informativo',
                'active' => 'adicionar-informativo'
            );
            return $app['twig']->render('admin_informativo_adicionar.html.twig', $data);
        }
    }
}
