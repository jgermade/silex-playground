<?php

    require __DIR__.'/vendor/autoload.php';
    // require_once 'lib/swift_required.php';

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use League\CommonMark\CommonMarkConverter;

    $settings = json_decode( file_get_contents(__DIR__."/config.json") );

    $pusher = new Pusher( $settings->pusher->app_key, $settings->pusher->app_secret, $settings->pusher->app_id, [
        'host' => $settings->pusher->host,
        'port' => $settings->pusher->port
    ] );

    $templates = new League\Plates\Engine('templates');


    $app = new Silex\Application();

    $app->get('/', function(Request $request) use ($templates) {
        $params = [
          channel => 'test',
          event => 'echo',
          message => '{ "hi": "all" }'
        ];

        return new Response( $templates->render('form', $params) , 200);
    });

    $app->post('/', function(Request $request) use ($pusher, $templates) {

        $params = [
          channel => $request->get('channel'),
          event => $request->get('event'),
          message => $request->get('message')
        ];


        $parsedMessage = json_decode($params['message'], true);

        if( $parsedMessage == null ) {
          $parsedMessage = $params['message'];
        }

        $pusher->trigger( $params['channel'], $params['event'], $parsedMessage );

        return new Response( $templates->render('form', $params) , 201);
    });

    $app->post('/pusher/auth', function(Request $request) use ($pusher) {

        $socketId = $request->get('socket_id');
        $channelName = $request->get('channel_name');

        $socketAuth = $pusher->socket_auth($channelName, $socketId);

        return new JsonResponse($socketAuth, 200);
    });

    $app->get('/chat/{chatId}', function(Request $request, $chatId) {

        $brokerId = $request->get('broker');
        $contactId = $request->get('contact');

        $response = new JsonResponse([
          broker => $brokerId,
          contact => $contactId
        ], 204);

        $response->headers->set('Location', '/chat/a987at9a87t9at');

        return $response;
    });

    $app->get('/chat/{chatId}/message', function(Request $request, $chatId) {

    });

    $app->get('/email', function(Request $request) use ($templates) {
        $params = [
          to => '',
          subject => '',
          message => ''
        ];

        return new Response( $templates->render('email', $params) , 201);
    });

    $app->post('/email', function(Request $request) use ($templates) {
        $params = [
          to => $request->get('to'),
          subject => $request->get('subject'),
          message => $request->get('message')
        ];

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('localhost', 1025)
          // ->setUsername('your username')
          // ->setPassword('your password')
          ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        $converter = new CommonMarkConverter();
        // Create a message
        $message = Swift_Message::newInstance($params['subject'])
          ->setFrom(array('peter@griffin' => 'Peter griffin'))
          ->setTo(array($params['to']))
          ->setBody($converter->convertToHtml($params['message']), 'text/html', 'UTF-8')
          ->addPart($params['message'], 'text/plain', 'UTF-8');

        // Send the message
        $result = $mailer->send($message);

        return new Response( $templates->render('email', $params) , 201);
    });

    $app->run();
