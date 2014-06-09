<?php


$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});

// Register routes.
$app->get('/', 'Condominio\Controller\IndexController::indexAction')->bind('homepage');
<<<<<<< HEAD

$app->get('/me', 'Conta\Controller\UserController::meAction')->bind('me');
$app->match('/login', 'Conta\Controller\UserController::loginAction')->bind('login');
$app->get('/logout', 'Conta\Controller\UserController::logoutAction')->bind('logout');
=======
>>>>>>> c224db2833bb9a4549f5f9d543ded80978da85ba

// Marcelo - Action de execução de emails
$app->get('/emails/bemvindo', 'Condominio\Controller\EmailsController::bemvindoAction')->bind('bemvindo');
$app->get('/emails/convidado', 'Condominio\Controller\EmailsController::convidadoAction')->bind('convidado');

<<<<<<< HEAD

=======
>>>>>>> c224db2833bb9a4549f5f9d543ded80978da85ba
$app->get('/me', 'Condominio\Controller\UserController::meAction')->bind('me');
$app->match('/login', 'Condominio\Controller\UserController::loginAction')->bind('login');
$app->get('/logout', 'Condominio\Controller\UserController::logoutAction')->bind('logout');
$app->get('/email/bemvindo', 'Condominio\Controller\IndexController::emailbemvindoAction')->bind('emailbemvindo');

$app->get('/admin/email/enviar/{idu}/{email}', 'Condominio\Controller\IndexController::emailSendAction')->bind('emailbemvindo')->value('idu',false)->value('email',false);

$app->get('/admin/index', 'Condominio\Controller\AdminController::indexAction')->bind('homeuser');
$app->get('/admin/reclamar/adicionar', 'Condominio\Controller\ReclamacaoController::adicionarAction')->bind('adicionar_reclamacao');
$app->get('/admin/reclamacao/{id}', 'Condominio\Controller\ReclamacaoController::viewAction')->bind('view')->value('id',false);
//$app->get('/admin/reclamacao', 'Condominio\Controller\ReclamacaoController::indexAction');
$app->get('/admin/reclamacao/minhas-reclamacoes/{page}', 'Condominio\Controller\ReclamacaoController::minhasReclamacoesAction')->bind('minhas_reclamacoes')->value('page',1);;

$app->post('/admin/reclamar/adicionar', 'Condominio\Controller\ReclamacaoController::adicionarAction')->bind('adicionar_reclamacao_post');

$app->get('/admin/morador', 'Condominio\Controller\MoradorController::listarAdminAction')->bind('admin_morador');
$app->get('/admin/morador/email', 'Condominio\Controller\MoradorController::listarEmailAdminAction')->bind('admin_morador_email');

$app->get('/admin/resposta/adicionar/{idr}', 'Condominio\Controller\RespostaController::adicionarAction')->bind('admin_resposta_adicionar')->value('idr',false);
$app->post('/admin/adicionar-resposta', 'Condominio\Controller\RespostaController::adicionarAction');