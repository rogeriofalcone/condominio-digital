<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Empreendimento;
use Condominio\Form\Type\ReclamacaoType;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;

class ConstrutoraController {

    public function indexAction(Request $request, Application $app) {
        
        $data = array(
            'active'=>'construtora',
            'metaDescription'=>'',
        );
        
        return $app['twig']->render('construtora.html.twig',$data);
    }
    
}
