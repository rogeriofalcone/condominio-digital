<?php

namespace Conta\Controller;

use Conta\Entity\Pgto;
use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPgtoController
{
    public function indexAction(Request $request, Application $app)
    {
        $limit = $request->query->get('limit', 20);
        $offset = $request->query->get('offset', 0);
        $pgtos = $app['repository.pgto']->findAll($limit, $offset);
        $data = array();
        foreach ($pgtos as $pgto) {
            $data[] = array(
                'id' => $pgto->getId(),
                'name' => $pgto->getName(),
            );
        }
        
        
        return new Response("OI", 200, array(
            'Cache-Control' => "s-maxage=$timeout",
            'Content-Type' => 'application/json',
            'Some-Custom-Header' => "1234445433",
            'Content-Length' => $len,
            'Pragma' => 'public',
            'Expires' => gmdate("D, d M Y H:i:s", time() + $timeout) . " GMT",
        ));


    }

    public function viewAction(Request $request, Application $app)
    {
        $pgto = $request->attributes->get('pgto');
        
        if (!$pgto) {
            return $app->json('Not Found', 404);
        }
        $pgtos = $app['repository.pgto']->find($pgto);
        
        $data = array(
            'id' => $pgtos->getId(),
            'name' => $pgtos->getName()
        );

        return $app->json($data);
    }
}
