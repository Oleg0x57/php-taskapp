<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 15.11.2018
 * Time: 22:34
 */

return [
    'MonologStreamHandler' => function () {
        $handler = new \Monolog\Handler\StreamHandler(dirname(__DIR__) . '/log/app.log', \Monolog\Logger::DEBUG);
        $handler->setFormatter(new \Monolog\Formatter\LineFormatter());
        return $handler;
    },
    'MonologRotatingFileHandler' => function () {
        $handler = new \Monolog\Handler\RotatingFileHandler(dirname(__DIR__) . '/log/app.log', 10, \Monolog\Logger::DEBUG);
        $handler->setFormatter(new \Monolog\Formatter\LineFormatter());
        return $handler;
    },
    'AppLog' => function (\Psr\Container\ContainerInterface $c) {
        $log = new \Monolog\Logger('app');
        $log->pushHandler($c->get('MonologRotatingFileHandler'));
        return $log;
    },
    'Twig' => function () {
        $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
        $twig = new Twig_Environment($loader);
        return $twig;
    },
    'TaskService' => function () {
        return new \App\TaskService();
    },
    'ProductService' => function () {
        return new \App\ProductService(new \App\ProductsArrayRepository());
    },
    'ProductController' => function (\Psr\Container\ContainerInterface $c) {
        return new \App\ProductController($c->get('ProductService'), $c->get('Twig'));
    },
    'ApiController' => function (\Psr\Container\ContainerInterface $c) {
        return new \App\ApiController($c->get('ProductService'));
    },
    'ProductApiController' => function (\Psr\Container\ContainerInterface $c) {
        return new \App\ProductApiController($c->get('ProductService'));
    },
    'Uri' => function () {
        return new \Zend\Diactoros\Uri($_SERVER['REQUEST_URI']);
    },
    'ServerRequest' => function (\Psr\Container\ContainerInterface $c) {
        $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
        return $request->withUri($c->get('Uri'));
    }
];