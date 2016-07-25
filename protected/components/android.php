<?php

class Android {

    var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "AIzaSyB0pn60wVKIycDZjF0BxUp5kArEQaRBn5M";
    var $devices = array('');

    /*
      Constructor
      @param $apiKeyIn the server API key
     */

    function Android() {

        /*$CI = & get_instance();

        $CI->config->load('android', TRUE);

        $config = $CI->config->item('android');

        foreach ($config as $key => $value) {
            $this->$key = $value;
        }

        return $this;*/
    }

    /*
      Set the devices to send to
      @param $deviceIds array of device tokens to send to
     */

    function setDevices($deviceIds) {
        if (is_array($deviceIds)) {
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }

        return $this;
    }

    /*
      Send the message to the device
      @param $message The message to send
      @param $data Array of data to accompany the message
     */

    function send($message, $data = false) {

        if (!is_array($this->devices) || count($this->devices) == 0) {
            $this->error("No devices set");
        }

        if (strlen($this->serverApiKey) < 8) {
            $this->error("Server API Key not set");
        }

        $fields = array(
            'registration_ids' => $this->devices,
            'data' => array("message" => $message, "action" => "", "id" => "")
        );
        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $fields['data'][$key] = $value;
            }
        }
        
        $headers = array(
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $this->url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Avoids problem with https certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute post
        $result = curl_exec($ch);
        //print_r($result);
        $error = curl_error($ch);

        // Close connection
        curl_close($ch);

        if (!empty($error)) {
            $this->error($error);
        }
        return $result;
    }

    function error($msg) {
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }

}