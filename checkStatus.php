<?php

if (isset($_POST['urls']) && !empty($_POST['urls'])) {
    $response = new CheckStatusHttp($_POST['urls']);
    foreach ($response->getStatus() as $status) {
        echo $status . '\\n';
    }
    
} else {
    echo ':(';
}

class CheckStatusHttp {
    private $statuses = []; 
    
    public function __construct($urls = []) {
        foreach ($urls as $url) {
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, '60');
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_NOBODY, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($ch);
            $curlInfo = curl_getinfo($ch);
            
            $isRedirect = ($curlInfo['redirect_url']) ? ' redirect: ' . (string)$curlInfo['redirect_url'] : '';
            $this->statuses[] = $url . ' -> ' . (string)$curlInfo['http_code'] . ' ' . $isRedirect;
        }
    }


    public function getStatus() {
        return $this->statuses;
    }
}
