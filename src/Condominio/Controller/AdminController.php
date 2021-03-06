<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AdminController {
    public function indexAction(Request $request, Application $app) {    
        return $app['twig']->render('admin_index.html.twig');      
    }
}
