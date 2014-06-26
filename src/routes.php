<?php

$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});

// Register routes.
$app->get('/', 'Condominio\Controller\IndexController::indexAction')->bind('homepage');

// Marcelo - Action de execução de emails
$app->get('/emails/bemvindo', 'Condominio\Controller\EmailsController::bemvindoAction')->bind('bemvindo');
$app->get('/emails/convidado', 'Condominio\Controller\EmailsController::convidadoAction')->bind('convidado');

$app->get('/me', 'Condominio\Controller\UserController::meAction')->bind('me');
$app->post('/me', 'Condominio\Controller\UserController::meAction')->bind('mePost');
$app->match('/login', 'Condominio\Controller\UserController::loginAction')->bind('login');
$app->get('/logout', 'Condominio\Controller\UserController::logoutAction')->bind('logout');
$app->get('/email/bemvindo', 'Condominio\Controller\IndexController::emailbemvindoAction')->bind('emailbemvindo');

$app->get('/morador/email/enviar/{idu}/{email}', 'Condominio\Controller\IndexController::emailSendAction')->bind('emailbemvindo')->value('idu',false)->value('email',false);

$app->get('/morador/index', 'Condominio\Controller\AdminController::indexAction')->bind('homeuser');
$app->get('/morador/ocorrencia/adicionar', 'Condominio\Controller\ReclamacaoController::adicionarAction')->bind('adicionar_reclamacao');

//$app->get('/admin/reclamacao', 'Condominio\Controller\ReclamacaoController::indexAction');
$app->get('/morador/ocorrencia/todas/{page}', 'Condominio\Controller\ReclamacaoController::todasReclamacoesAction')->bind('todas_reclamacoes')->value('page',1);;
$app->get('/morador/ocorrencia/pendentes/{page}', 'Condominio\Controller\ReclamacaoController::todasReclamacoesAction')->bind('pendente_reclamacoes')->value('page',1);;
$app->get('/morador/ocorrencia/fechadas/{page}', 'Condominio\Controller\ReclamacaoController::todasReclamacoesAction')->bind('fechada_reclamacoes')->value('page',1);;
$app->get('/morador/ocorrencia/abertas/{page}', 'Condominio\Controller\ReclamacaoController::todasReclamacoesAction')->bind('aberta_reclamacoes')->value('page',1);;
$app->get('/morador/ocorrencia/minhas-reclamacoes/{page}', 'Condominio\Controller\ReclamacaoController::minhasReclamacoesAction')->bind('minhas_reclamacoes')->value('page',1);;

$app->get('/morador/ocorrencia/{id}', 'Condominio\Controller\ReclamacaoController::viewAction')->bind('view')->value('id',false);
//
$app->post('/morador/ocorrencia/adicionar', 'Condominio\Controller\ReclamacaoController::adicionarAction')->bind('adicionar_reclamacao_post');
$app->post('/morador/adicionar/foto', 'Condominio\Controller\ReclamacaoController::adicionarFotoAction');

$app->post('/morador/salvar', 'Condominio\Controller\MoradorController::adicionarAction')->bind('adicionar-morador-salvar');
$app->get('/morador/adicionar-morador', 'Condominio\Controller\MoradorController::adicionarAction')->bind('adicionar-morador');

$app->get('/morador/morador', 'Condominio\Controller\MoradorController::listarAdminAction')->bind('admin_morador');
$app->get('/morador/adicionar-morador/{id}', 'Condominio\Controller\MoradorController::adicionarAction')->bind('edit-morador');
$app->get('/morador/excluir/{id}', 'Condominio\Controller\MoradorController::excluirAction')->bind('excluir-morador');

$app->get('/morador/morador/email', 'Condominio\Controller\MoradorController::listarEmailAdminAction')->bind('admin_morador_email');
$app->get('/morador/morador/notificacoes', 'Condominio\Controller\MoradorController::notificacoesAction')->bind('admin_morador_notificacoes');
$app->get('/morador/morador/alterar-foto', 'Condominio\Controller\MoradorController::alterarFotoAction')->bind('admin_morador_foto');
$app->post('/morador/morador/alterar-foto', 'Condominio\Controller\MoradorController::alterarFotoAction')->bind('admin_morador_foto_enviar');

$app->get('/sindico', 'Condominio\Controller\AdministracaoController::listarSindicoAction')->bind('listar-sindico');
$app->get('/administracao', 'Condominio\Controller\AdministracaoController::listarAdminAction')->bind('admin-administracao');
$app->get('/administracao/adicionar-usuario', 'Condominio\Controller\AdministracaoController::adicionarAction')->bind('adicionar-usuario');

$app->get('/condominio/documento', 'Condominio\Controller\AdministracaoController::listarDocumentoAction')->bind('listar-documento');
$app->get('/condominio/adicionar-documento', 'Condominio\Controller\AdministracaoController::adicionarDocumentoAction')->bind('adicionar-documento');
$app->post('/condominio/salvar-documento', 'Condominio\Controller\AdministracaoController::adicionarDocumentoAction')->bind('salvar-documento');

$app->get('/moradorresposta/adicionar/{idr}', 'Condominio\Controller\RespostaController::adicionarAction')->bind('admin_resposta_adicionar')->value('idr',false);
$app->post('/morador/adicionar-resposta', 'Condominio\Controller\RespostaController::adicionarAction');