<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Empreendimento;

class EmpreendimentoController {

    public function apiAction(Request $request, Application $app) {

        $limit = $request->query->get('limit', 20);
        $offset = $request->query->get('offset', 0);
        $emps = $app['repository.empreendimento']->findAll($limit, $offset);
        $data = array();
        foreach ($emps as $emp) {
            $data[] = array(
                'id' => $emp->getId(),
                'nome' => $emp->getNome(),
            );
        }
        return $app->json($data);
    }
    public function updateUsuarioAction(Request $request, Application $app) {

        $idnome = $request->get("idnome");
        
        if ($idnome != "") {
            $oEmp = $app['repository.empreendimento']->findIdNome($idnome);
        }
        if($oEmp){
            
            if ($app['token']) {
               $uid = $app['token']->getUid();
            }else{
                return false;
            }
            
            $userData = array('idemp'=>$oEmp->getId());
            $app['repository.user']->updateMeuCondominio($uid,$userData);
             /*
                * Enviar email
                
                $body = $app['twig']->render('emailBemVindo.html.twig',
                        array(
                            'name' => $validBemVindo->getName(),
                            'mail' => $validBemVindo->getEmail(),
                        ));

                $message = \Swift_Message::newInstance()
                                ->setSubject('[Reclame Imóvel] Parabéns pelo cadastro. ')
                                ->setFrom(array('contato@reclameimovel.com.br'=>'Reclame Imóvel'))
                                ->setTo(array($validBemVindo->getEmail()=>$validBemVindo->getName()))
                                ->setBody($body)
                                ->setContentType("text/html");

                $app['mailer']->send($message);   
              * */
            
            $message = 'Você não vai mais precisar procurar seu condomínio/empreendimento para poder reclamar pois agora ja sabem qual é o seu empreendimento.';
            $app['session']->getFlashBag()->add('info', $message);

            return $app->redirect("/empreendimento/$idnome");
        }

    }

}
