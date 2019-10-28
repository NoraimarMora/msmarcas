<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Broker {
    
  public static function notify($queue, $obj) {

    $HOST = env('MB_HOST');
    $USER = env('MB_USER');
    $PASS = env('MB_PASS');

    $connection = new AMQPStreamConnection($HOST, 5672, $USER, $PASS, $USER);
    $channel = $connection->channel();

    $channel->queue_declare($queue, false, true, false, false);

    $msg = new AMQPMessage(json_encode($obj));
    $channel->basic_publish($msg, '', $queue);

    fwrite(fopen("broker_logs.txt", "w"), "[PUBLISHER] - published " . json_encode($obj));

    $connection->close();
    $channel->close();
  }

}

?>

