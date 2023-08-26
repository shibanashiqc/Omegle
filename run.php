<?php 

require_once __DIR__ . '/vendor/autoload.php';

use Shibanashiqc\Omegle\ApiRequest;

while(true) :
    
$omegle = new ApiRequest();
// $omegle->setProxy('http://username:password@ip:port');  // Set Proxy username:password@ip:port
$omegle->generateUserAgent();
$randId = $omegle->setCc();
// $omegle->setTopics('["malappuram", "kerala"]'); // Set topics
$start = $omegle->getServer();
echo json_encode($start);

if(isset($start->clientID)) {
  
$clientId = $start->clientID;
$omegle->setClientId($clientId);
echo "Client ID: $clientId\n";

echo $omegle->getEvents();
sleep(3);

if($omegle->getEvents() == null ) {
    echo "No one is online\n";
    continue;
}

echo "\n";
echo $msg = $omegle->sendMsg($clientId, 'Hi there! follow me on insta @al33na55');
echo "\n";

echo $omegle->getTyping();
echo "\n";
echo $omegle->getStoppedTyping();
sleep(3);
echo "\n";
echo $omegle->getEvents();
echo "\n";
echo $omegle->getDisconnect();
echo "\n";

} else {
    echo "No one is online\n";
    continue;
}


endwhile;