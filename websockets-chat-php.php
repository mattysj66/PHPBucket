<?php

// Set the WebSocket server IP and port
$address = '0.0.0.0';
$port = 8000;

// Create a new WebSocket server
$server = new \Ratchet\Server\IoServer(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new \Ratchet\Wamp\WampServer(
                new Chat()
            )
        )
    ),
    $port,
    $address
);

// Start the WebSocket server
$server->run();

// Chat class
class Chat implements \Ratchet\Wamp\WampServerInterface {
    // Keep track of connected clients
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    // When a client connects
    public function onOpen(\Ratchet\ConnectionInterface $conn) {
        // Add the client to the list of connected clients
        $this->clients->attach($conn);
    }

    // When a client sends a message
    public function onMessage(\Ratchet\ConnectionInterface $from, $msg) {
        // Send the message to all connected clients
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    // When a client disconnects
    public function onClose(\Ratchet\ConnectionInterface $conn) {
        // Remove the client from the list of connected clients
        $this->clients->detach($conn);
    }

    public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e) {
        // Close the connection if there is an error
        $conn->close();
    }
}

?>