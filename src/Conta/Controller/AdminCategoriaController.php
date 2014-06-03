<?php

namespace Conta\Controller;

use Conta\Entity\Categoria;
use Conta\Form\Type\CategoriaType;
use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class AdminCategoriaController
{
    public function indexAction(Request $request, Application $app)
    {
        // Perform pagination logic.
        $limit = 10;
        $total = $app['repository.categoria']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $artists = $app['repository.categoria']->findAll($limit, $offset);

        $data = array(
            'categorias' => $artists,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('admin_categorias'),
        );
        return $app['twig']->render('admin_categorias.html.twig', $data);
    }

    public function addAction(Request $request, Application $app)
    {
        $artist = new Categoria();
        $form = $app['form.factory']->create(new CategoriaType(), $artist);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.artist']->save($artist);
                $message = 'The artist ' . $artist->getName() . ' has been saved.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('admin_artist_edit', array('artist' => $artist->getId()));
                return $app->redirect($redirect);
            }
        }

        $data = array(
            'form' => $form->createView(),
            'title' => 'Add new artist',
        );
        return $app['twig']->render('form.html.twig', $data);
    }

    public function editAction(Request $request, Application $app)
    {
        $artist = $request->attributes->get('artist');
        if (!$artist) {
            $app->abort(404, 'The requested artist was not found.');
        }
        $form = $app['form.factory']->create(new ArtistType(), $artist);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.artist']->save($artist);
                $message = 'The artist ' . $artist->getName() . ' has been saved.';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }

        $data = array(
            'form' => $form->createView(),
            'title' => 'Edit artist ' . $artist->getName(),
        );
        return $app['twig']->render('form.html.twig', $data);
    }

    public function deleteAction(Request $request, Application $app)
    {
        $artist = $request->attributes->get('artist');
        if (!$artist) {
            $app->abort(404, 'The requested artist was not found.');
        }

        $app['repository.artist']->delete($artist);
        return $app->redirect($app['url_generator']->generate('admin_artists'));
    }
}
