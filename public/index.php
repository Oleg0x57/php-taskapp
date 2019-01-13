<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 15.11.2018
 * Time: 22:33
 */

require dirname(__DIR__) . '/vendor/autoload.php';

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $message = '[' . $errno . '] ' . $errstr;
    throw new Exception($message);
});

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(dirname(__DIR__) . '/config/common.php');
$container = $containerBuilder->build();
$logger = $container->get('AppLog');
$twig = $container->get('Twig');
/** @var \Psr\Http\Message\ServerRequestInterface $request */
$request = $container->get('ServerRequest');
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/task/{action:\w+}/{id:\d+}', 'TaskService');
    $r->addRoute(['GET', 'POST', 'PUT', 'DELETE'], '/api/v1/products[/{id:\d+}]', 'products_api');
    $r->addRoute('GET', '/api[/{action:\w+}[/{id:\d+}]]', 'ApiController');
    $r->addRoute('GET', '/product[/{action:\w+}[/{id:\d+}]]', 'ProductController');
    $r->addRoute('GET', '/info', 'info');
    $r->addRoute('GET', '/', 'ProductController');
});

$httpMethod = $request->getMethod();
$uri = $request->getUri();

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $response = new \Zend\Diactoros\Response\HtmlResponse($twig->render('404.html'), 404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        try {
            if ($routeInfo[1] === 'info') {
                $response = new \Zend\Diactoros\Response\HtmlResponse($twig->render('info.html'));
            } else if ($routeInfo[1] === 'products_api') {
                $controller = $container->get('ProductApiController');
                $id = null;
                $method = $request->getMethod();
                if($method === 'PUT'){
                    $putBody = [];
                    mb_parse_str((string)$request->getBody(), $putBody);
                    $request = $request->withParsedBody($putBody);
                }
                $params = $request->getParsedBody();
                extract($routeInfo[2]);
                $result = $controller->respond($method, $id, $params);
                $response = new \Zend\Diactoros\Response\JsonResponse($result, 200);
            } else {
                $handler = $container->get($routeInfo[1]);
                $vars = $routeInfo[2];
                extract($vars);
                if (isset($action) && isset($id)) {
                    $result = $handler->$action($id);
                } elseif (isset($action)) {
                    $result = $handler->$action();
                } else {
                    $action = 'index';
                    $result = $handler->$action();
                }
                if ($handler instanceof \App\ApiController) {
                    $response = new \Zend\Diactoros\Response\JsonResponse($result, 200);
                } elseif ($handler instanceof \App\ProductController) {
                    $response = new \Zend\Diactoros\Response\HtmlResponse($result, 200);
                }
            }
        } catch (Throwable $exception) {
            $result = $twig->render('error.html', ['error' => $exception->getMessage()]);
            $response = new \Zend\Diactoros\Response\HtmlResponse($result, 500);
        }
        break;
}

if (!headers_sent()) {
    foreach ($response->getHeaders() as $name => $value) {
        header($name . ': ' . implode(',', $value));
    }
}
header(sprintf(
    'HTTP/%s %s %s',
    $response->getProtocolVersion(),
    $response->getStatusCode(),
    $response->getReasonPhrase()
), true, $response->getStatusCode());
echo $response->getBody();