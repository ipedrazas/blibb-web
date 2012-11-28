<?php
error_reporting(E_ALL);


ini_set("extension_dir", dirname(__FILE__).'/modules');
if (!extension_loaded("amqp")) {
    dl("amqp.so");
}

if (!extension_loaded("amqp")) {
    die("extension amqp not loaded!\n");
}


$hostname = "localhost";
$port     = 5672;

// create a connection ...
$connection = amqp_connection_popen($hostname, $port );

$user = "guest";
$pass = "guest";
$vhost = "/";

// login
$res = amqp_login($connection, $user, $pass, $vhost);

// open channel
$channel_id = 1;
$res = amqp_channel_open($connection, $channel_id);

$queue = 'MyQueue';
$exchange ="myexchange.direct";
$routing_key = "RoutingKey";

// optional: declare exchange, declare queue, bind queue
#$res = amqp_exchange_declare($connection, $channel_id, $exchange, "direct");
#$res = amqp_queue_declare($connection, $channel_id, $queue, $passive = false, $durable = false, $exclusive = false, $auto_delete = true);
#$res = amqp_queue_bind($connection, $channel_id, $queue, $exchange, $routing_key);

// optinal, specify options for basic_publish()
$options = array(
    "content_type" => "ContentType",
    "content_encoding" => "ContentEncoding",
    "delivery_mode" => 2,
    "priority" => 1,
    "correlation_id" => "correlation_id",
    "reply_to" => "reply_to",
    "expiration" => "tomorowww",
    "message_id" => "id of the message",
    "timestamp" => time(),
    "type" => "type of the message",
    "user_id" => "userId!",
    "app_id" => "ApplicationId",
    "cluster_id" => "ClusterId!"
);


// send the message to rabbitmq
$body = "Message Body";
$start = microtime(true);
for ($i = 0; $i < 10; $i++) {
    $res = amqp_basic_publish($connection, $channel_id, $exchange, $routing_key, $body, false, false, $options);
}


$end = microtime(true);
echo "Total publish time: " . ($end - $start) ."\n";
amqp_connection_close($connection);


?>