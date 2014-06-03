<?php


$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});

// Register routes.
$app->get('/', 'Condominio\Controller\IndexController::indexAction')->bind('homepage');

$app->get('/me', 'Conta\Controller\UserController::meAction')->bind('me');
$app->match('/login', 'Conta\Controller\UserController::loginAction')->bind('login');
$app->get('/logout', 'Conta\Controller\UserController::logoutAction')->bind('logout');
$app->get('/email/bemvindo', 'Condominio\Controller\IndexController::emailbemvindoAction')->bind('emailbemvindo');
$app->get('/admin/email/enviar/{idu}/{email}', 'Condominio\Controller\IndexController::emailSendAction')->bind('emailbemvindo')->value('idu',false)->value('email',false);
$app->get('/api/pgto', 'Conta\Controller\ApiPgtoController::indexAction');
$app->get('/api/pgto/{pgto}', 'Conta\Controller\ApiPgtoController::viewAction')->value('pgto',false);

$app->get('/admin/morador', 'Condominio\Controller\MoradorController::listarAdminAction')->bind('admin_morador');
$app->get('/admin/morador/email', 'Condominio\Controller\MoradorController::listarEmailAdminAction')->bind('admin_morador_email');

$app->get('/admin/resposta/adicionar/{idr}', 'Condominio\Controller\RespostaController::adicionarAction')->bind('admin_resposta_adicionar')->value('idr',false);
$app->post('/admin/adicionar-resposta', 'Condominio\Controller\RespostaController::adicionarAction');