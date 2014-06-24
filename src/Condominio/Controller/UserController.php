<?php

namespace Condominio\Controller;

use Condominio\Entity\User;
use Condominio\Form\Type\UserType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    public function meAction(Request $request, Application $app)
    {
        
        
        $token = $app['security']->getToken();
        $user = $token->getUser();
     
        if ($request->isMethod('POST')) {
            //echo "OK";
        }

        $data = array(
            'user' => $user,
            'error' => $app['security.last_error']($request),
        );
        
        return $app['twig']->render('profile.html.twig', $data);
    }

    public function loginAction(Request $request, Application $app)
    {
        $form = $app['form.factory']->createBuilder('form')
            ->add('username', 'text', array('label' => 'Email','attr'=>array('class','input-block-level'), 
                'data' => $app['session']->get('_security.last_username')))
            ->add('password', 'password', array('label' => 'Password','attr'=>array('class','input-block-level'),))
            ->add('Entrar', 'submit', array('attr'=>array('class'=>'btn btn-large btn-primary')))
            ->getForm();

        $data = array(
            'form'  => $form->createView(),
            'error' => $app['security.last_error']($request),
        );
        return $app['twig']->render('login.html.twig', $data);
    }

    public function logoutAction(Request $request, Application $app)
    {
        $app['session']->clear();
        return $app->redirect($app['url_generator']->generate('homepage'));
    }
}
