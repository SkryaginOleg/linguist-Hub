<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
class ChatServer implements MessageComponentInterface
{
    protected $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection! ({$conn->resourceId})\n";
    }
    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message received: $msg\n";
        $data = json_decode($msg, true);

        if (isset($data['type']) && $data['type'] === 'init' && isset($data['userId'])) {
            $userId = $data['userId'];

            foreach ($this->clients as $client) {
                if ($this->clients[$client] === $userId) {
                    $this->clients->detach($client);
                    echo "User reconnected! ({$from->resourceId})\n";
                    return;
                }
            }

            $this->clients->attach($from, $userId);
            echo "User initialized! ({$from->resourceId})\n";
            return;
        }
        if (isset($data['chatName']) && isset($data['message']) && isset($data['userId'])) {
            $chatName = $data['chatName'];
            $message = $data['message'];
            $userId = $data['userId'];
            $userName = $data['userName'];

            echo "Broadcasting message to chatName: $chatName\n";
            echo "userName: $userName\n";
            echo "userId: $userId\n";
            echo "message: $message\n";

            foreach ($this->clients as $client) {
                $clientUserId = $this->clients[$client];
                echo "Checking client with userId: $clientUserId\n";

                if($clientUserId != $userId){
                    $client->send($msg);
                    echo "Message sent to userId: $clientUserId\n";
                } 
            }
        }
    }
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function listClients()
    {
        echo "Listing all connected clients:\n";
        foreach ($this->clients as $client) {
            $userId = $this->clients[$client];
            echo "Connection: {$client->resourceId}, User ID: $userId\n";
        }
    }
}
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    8000
);
echo "WebSocket server started on port 8000\n";
$server->run();