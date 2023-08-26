<?php 

namespace Shibanashiqc\Omegle;

class ApiRequest {
    
    protected $api_url, $check_url = 'waw4.omegle.com/check', $cc;
    protected $server_url, $client_id, $topics, $userAgent = 'Mozilla/5.0 (Windows NT 6.1; rv:60.0) Gecko/20100101 Firefox/60.0';
    protected $proxy; 
    
    
    public function __construct() {
        $this->api_url = 'http://front10.omegle.com/';
    }  
    
    public function setTopics($topics) {
        $this->topics = $topics;
    }
    
    public function setProxy($proxy) {
        $this->proxy = $proxy;
    }
    
    public function getTopics() {
        return $this->topics;
    }
    
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }
    
    
    public function getServer() {
        $url = $this->api_url .'start?caps=recaptcha2,t3&firstevents=1&spid=&cc='.$this->cc.'&lang=en&topics='. $this->topics ;
        $response = $this->request($url);
        $response = json_decode($response);
        return  $response;
    }
    
    public function getEvents() {
        $response = $this->api_url . 'events';
        $response = $this->request($response, 'POST', ['id' => $this->client_id]);
        return $response;
    }
    
    public function getDisconnect() {
        $response = $this->api_url . 'disconnect';
        $response = $this->request($response, 'POST', ['id' => $this->client_id]);
        return $response;
    }
    
    public function getTyping() {
        $response = $this->api_url . 'typing';
        $response = $this->request($response, 'POST', ['id' => $this->client_id]);
        return $response;
    }
    
    public function getStoppedTyping() {
        $response = $this->api_url . 'stoppedtyping';
        $response = $this->request($response, 'POST', ['id' => $this->client_id]);
        return $response;
    }
    
    public function getSend($clientID, $msg) {
        $response = $this->api_url . 'send';
        $response = $this->request($response, 'POST', ['id' => $clientID, 'msg' => $msg]);
        return $response;
    }
    
    public function getReCaptcha() {
        $response = $this->api_url . 'recaptcha';
        $response = $this->request($response, 'POST', ['id' => $this->client_id]);
        return $response;
    }
    
    public function getReport() {
        $response = $this->api_url . 'report';
        return $response;
    }
    
    public function getSpyee() {
        $response = $this->api_url . 'spyee';
        return $response;
    }
    
    public function getSpyQueue() {
        $response = $this->api_url . 'spyqueue';
        return $response;
    }
    
    public function getSpyDisconnect() {
        $response = $this->api_url . 'spydisconnect';
        return $response;
    }
    
    public function getEvents2() {
        $response = $this->api_url . 'events2';
        return $response;
    }
    
    
    public function getEvents3() {
        $response = $this->api_url . 'events3';
        return $response;
    }
    
    public function getEvents4() {
        $response = $this->api_url . 'events4';
        return $response;
    }
    
    public function request($url, $method = 'GET', $data = []) {
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_PROXY => $this->proxy,
        CURLOPT_USERAGENT => $this->userAgent,
        CURLOPT_POSTFIELDS => urldecode(http_build_query($data)),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public function generateUserAgent()
    {
        $file = 'user-agents.json';
        $userAgents = json_decode(file_get_contents($file), true);
        $userAgent = $userAgents[array_rand($userAgents)];
        return $userAgent;
    }
    
    public function setUa() {
        $ua = $this->generateUserAgent();
        $this->userAgent = $ua;
    }
    
    public function setCc() {
        $server = $this->getServer();
        $this->check_url = $server->events[1][1]->antinudeservers[0]. '/check' ?? $this->check_url;
        $request = $this->request($this->check_url, 'POST');
        $this->cc = $request;
        return $request;
    }
}




