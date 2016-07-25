<?php 
 class Ios {

    private $host = 'gateway.push.apple.com';
    private $port = 2195;
    private $cert = 'http://bhukkas.com/key/bhukkas.pem';
    private $pass = '123456';
    private $device = NULL;
    private $message = NULL;
    private $badge = NULL;
    private $sound = 'default';
    //private $_CI;

    /*
     * Class constructor
     */

    public function __construct() {
        
        //$this->$key = $value;
       
    }

    /*
     * Set device ID
     */

    public function to($device) {
        $this->device = $device;

        return $this;
    }

    /*
     * set message
     */

    public function message($message) {
        $this->message = $message;

        return $this;
    }

    /*
     * Set badge
     */

    public function badge($badge = 1) {
        $this->badge = $badge;

        return $this;
    }

    /*
     * Set sound
     */

    public function sound($sound = 'default') {
        $this->sound = $sound;

        return $this;
    }

    
    /*
     * Send Push notification message to IOS device.
     */

    public function send($data = false) {

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $this->cert);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->pass);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://' . $this->host . ':' . $this->port, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        }

        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'body' => $this->message,
                'action' => '',
                'id' => ''
            ),
            'sound' => 'default',
            'badge' =>$this->badge
        );
        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $body['aps']['alert'][$key] = $value;
            }
        }
        
        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $this->device) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);
    }

}
?>