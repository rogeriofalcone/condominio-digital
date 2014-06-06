<?php
namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of EmailsController
 *
 * @author marcelo
 */
class EmailsController {
    //put your code here
    
    public function bemvindoAction(Request $request, Application $app) {
        $data = array(
                'name' => "Marcelo Pereira",
                'email' => "marcelo@marcelowebti.com",
                //'uri' => '/empreendimento',
                
            );

            return $app['twig']->render('emailBemVindo.html.twig', $data);
    }
}
