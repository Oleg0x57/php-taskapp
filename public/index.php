<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 15.11.2018
 * Time: 22:33
 */

require dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(dirname(__DIR__) . '/config/common.php');
$container = $containerBuilder->build();
$logger = $container->get('AppLog');
$twig = $container->get('Twig');
/** @var \Psr\Http\Message\ServerRequestInterface $request */
$request = $container->get('ServerRequest');
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/task/{action:\w+}/{id:\d+}', 'TaskService');
    $r->addRoute('GET', '/info', 'info');
});

$httpMethod = $request->getMethod();
$uri = $request->getUri();

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        if ($routeInfo[1] === 'info') {
            $response = new \Zend\Diactoros\Response\HtmlResponse($twig->render('index.html'));
        } else {
            $handler = $container->get($routeInfo[1]);
            $vars = $routeInfo[2];
            extract($vars);
            $result = $handler->$action($id);
            $response = new \Zend\Diactoros\Response\JsonResponse($result, 200);
        }
        break;
}

if (!headers_sent()) {
    foreach ($response->getHeaders() as $name => $value) {
        header($name . ': ' . implode(',', $value));
    }
}
echo $response->getBody();