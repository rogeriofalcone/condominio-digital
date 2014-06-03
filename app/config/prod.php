<?php

// Timezone.
date_default_timezone_set('America/Sao_Paulo');

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

// Emails.
$app['admin_email'] = 'contato@reclameimovel.com.br';
$app['site_email'] = 'contato@reclameimovel.com.br';

// Doctrine (db)
$app['dbs.options'] = array(
    'db'=> array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'port'     => '3306',
        'dbname'   => 'condominioadm',
        'user'     => 'condominio',
        'password' => 'datasus',
    ),
    'dbreclame'=> array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'port'     => '3306',
        'dbname'   => 'condominio',
        'user'     => 'condominio',
        'password' => 'datasus',
    ),
);
// See http://silex.sensiolabs.org/doc/providers/swiftmailer.html
$app['swiftmailer.options'] = array(
    'host' => 'host',
    'port' => '25',
    'username' => 'username',
    'password' => 'password',
    'encryption' => null,
    'auth_mode' => null
);
