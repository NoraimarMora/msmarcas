<?php

  namespace App;

  require_once __DIR__ . '/vendor/autoload.php';
  use PhpAmqpLib\Connection\AMQPStreamConnection;
  use PhpAmqpLib\Message\AMQPMessage;

  $HOST = getenv('MB_HOST');
  $USER = getenv('MB_USER');
  $PASS = getenv('MB_PASS');

  class Broker {
      public function notify($queue, $obj) {
        $connection = new AMQPStreamConnection($HOST, 5672, $USER, $PASS);
        $channel = $this->connection->channel();

        $channel->queue_declare($queue, false, false, false, false);

        $msg = new AMQPMessage(json_encode($obj));
        $channel->basic_publish($msg, '', $queue);

        echo "[PUBLISHER] - published $obj";

        $connection->close();
        $channel->close();
      }
  }

?>

