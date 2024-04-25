<?php
//require_once 'vendor/hola.php';
require_once 'vendor/autoload.php'; 
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class VottunSDK {
    private $apiApp;
    private $apiKey;
    private $baseUrl; 

    public function __construct($baseUrl, $apiApp, $apiKey) {
        $this->baseUrl = $baseUrl;
        $this->apiApp = $apiApp;
        $this->apiKey = $apiKey;
       
    }

    private function makeRequest($method, $url, $data = []) {
        try {
            $client = new Client([
            'verify' => false // Desactivar la verificación del certificado SSL
        ]);
            $response = $client->request($method, $url, [
                'json' => $data,
                'headers' => [
                    'x-application-vkn' => $this->apiApp,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new Exception('Error making request: ' . $e->getMessage());
        }
    }

/* ERC-20 */

 public function balanceOfErc20($contractAddress, $network, $address) {
    $url = "{$this->baseUrl}/erc/v1/erc20/balanceOf";
    $data = compact('contractAddress', 'network', 'address');
    return $this->makeRequest('GET', $url, $data);
}

public function totalSupplyErc20($contractAddress, $network) {
    $url = "{$this->baseUrl}/erc/v1/erc20/totalSupply";
    $data = compact('contractAddress', 'network');
    return $this->makeRequest('GET', $url, $data);
}

public function allowanceErc20($contractAddress, $network, $owner, $spender) {
    $url = "{$this->baseUrl}/erc/v1/erc20/allowance";
    $data = compact('contractAddress', 'network', 'owner', 'spender');
    return $this->makeRequest('GET', $url, $data);
}

public function nameErc20($contractAddress, $network) {
    $url = "{$this->baseUrl}/erc/v1/erc20/name";
    $data = compact('contractAddress', 'network');
    return $this->makeRequest('GET', $url, $data);
}

public function symbolErc20($contractAddress, $network) {
    $url = "{$this->baseUrl}/erc/v1/erc20/symbol";
    $data = compact('contractAddress', 'network');
    return $this->makeRequest('GET', $url, $data);
}

public function decimalsErc20($contractAddress, $network) {
    $url = "{$this->baseUrl}/erc/v1/erc20/decimals";
    $data = compact('contractAddress', 'network');
    return $this->makeRequest('GET', $url, $data);
}

public function transferErc20($contractAddress, $recipient, $network, $amount, $gasLimit) {
    $url = "{$this->baseUrl}/erc/v1/erc20/transfer";
    $data = compact('contractAddress', 'recipient', 'network', 'amount', 'gasLimit');
    return $this->makeRequest('POST', $url, $data);
}

public function deployErc20($name, $symbol, $alias, $initialSupply, $network, $gasLimit) {
    $url = "{$this->baseUrl}/erc/v1/erc20/deploy";
    $data = compact('name', 'symbol', 'alias', 'initialSupply', 'network','gasLimit');
    return $this->makeRequest('POST', $url, $data);
}

public function transferFromErc20($contractAddress, $sender, $recipient, $network, $amount, $gasLimit) {
    $url = "{$this->baseUrl}/erc/v1/erc20/transferFrom";
    $data = compact('contractAddress', 'sender', 'recipient', 'network', 'amount','gasLimit');
    return $this->makeRequest('POST', $url, $data);
}

public function increaseAllowanceErc20($contractAddress, $spender, $network, $gasLimit, $addedValuet) {
    $url = "{$this->baseUrl}/erc/v1/erc20/increaseAllowance";
    $data = compact('contractAddress', 'spender', 'network', 'gasLimit','addedValuet');
    return $this->makeRequest('POST', $url, $data);
}

public function decreaseAllowanceErc20($contractAddress, $spender, $network, $gasLimit, $subtractedValue) {
    $url = "{$this->baseUrl}/erc/v1/erc20/decreaseAllowance";
    $data = compact('contractAddress', 'spender', 'network', 'gasLimit','subtractedValue');
    return $this->makeRequest('POST', $url, $data);
}

/* erc-721 */
public function balanceOfErc721($contractAddress, $network, $address) {
    $url = "{$this->baseUrl}/erc/v1/erc721/balanceOf";
    $data = compact('contractAddress', 'network', 'address');
    return $this->makeRequest('GET', $url, $data);
}

public function tokenUriErc721($contractAddress, $network, $id) {
    $url = "{$this->baseUrl}/erc/v1/erc721/tokenUri";
    $data = compact('contractAddress', 'network', 'id');
    return $this->makeRequest('POST', $url, $data);
}

public function ownerOfErc721($contractAddress, $network, $id) {
    $url = "{$this->baseUrl}/erc/v1/erc721/ownerOf";
    $data = compact('contractAddress', 'network', 'id');
    return $this->makeRequest('GET', $url, $data);
}

public function deployErc721($name, $symbol, $network, $gasLimit, $alias) {
    $url = "{$this->baseUrl}/erc/v1/erc721/deploy";
    $data = compact('name', 'symbol', 'network', 'gasLimit', 'alias');
    return $this->makeRequest('POST', $url, $data);
}

public function mintErc721($recipientAddress, $tokenId, $ipfsUri, $ipfsHash, $network, $contractAddress, $royaltyPercentage, $gas) {
    $url = "{$this->baseUrl}/erc/v1/erc721/mint";
    $data = compact('recipientAddress', 'tokenId', 'ipfsUri', 'ipfsHash', 'network', 'contractAddress', 'royaltyPercentage', 'gas');
    return $this->makeRequest('POST', $url, $data);
}

public function transferErc721($contractAddress, $network, $id, $from, $to) {
    $url = "{$this->baseUrl}/erc/v1/erc721/transfer";
    $data = compact('contractAddress', 'recipient', 'network', 'amount', 'gasLimit');
    return $this->makeRequest('POST', $url, $data);
}

/* erc-1155 */

public function balanceOfErc1155($contractAddress, $network, $address, $id) {
    $url = "{$this->baseUrl}/erc/v1/erc1155/balanceOf";
    $data = compact('contractAddress', 'network', 'address', 'id');
    return $this->makeRequest('GET', $url, $data);
}

public function tokenUriErc1155($contractAddress, $network, $id) {
    $url = "{$this->baseUrl}/erc/v1/erc1155/tokenUri";
    $data = compact('contractAddress', 'network', 'id');
    return $this->makeRequest('POST', $url, $data);
}

public function deployErc1155($name, $symbol, $ipfsUri, $royaltyRecipient, $royaltyValue, $networkauxi, $gasLimit, $alias) {
    $url = "{$this->baseUrl}/erc/v1/erc1155/deploy";
    $data = compact('name', 'symbol', 'ipfsUri', 'royaltyRecipient', 'royaltyValue', 'network', 'gasLimit', 'alias');
    return $this->makeRequest('POST', $url, $data);
}

public function mintErc1155($contractAddress, $network, $to, $id, $amount) {
    $url = "{$this->baseUrl}/erc/v1/erc1155/mint";
    $data = compact( 'contractAddress', 'network', 'to', 'id', 'amount');
    return $this->makeRequest('POST', $url, $data);
}

public function transferErc1155($contractAddress, $network, $to, $id, $amount) {
    $url = "{$this->baseUrl}/erc/v1/erc1155/transfer";
    $data = compact('contractAddress', 'network', 'to', 'id', 'amount');
    return $this->makeRequest('POST', $url, $data);
}

//Custodied Wallets
//new hash
public function newHashCwll($username, $strategies, $callbackUrl, $fallbackUrl, $cancelUrl) {
    $url = "{$this->baseUrl}/cwll/v1/hash/new";
    $data = compact('username', 'strategies', 'callbackUrl', 'fallbackUrl', 'cancelUrl');
    return $this->makeRequest('POST', $url, $data);
}

//Get Custodied Wallet Address
public function addressCwll($userEmail) {
    $url = "{$this->baseUrl}/cwll/v1/evm/wallet/custodied/address";
    $data = compact('userEmail');
    return $this->makeRequest('GET', $url, $data);
}

//Get Customer Custodied Wallets
public function listCwll() {
    $url = "{$this->baseUrl}/cwll/v1/evm/wallet/custodied/list";
    $data = compact('');
    return $this->makeRequest('GET', $url, $data);
}


}

//---------------------------------- AQUI SE MANDA A EJECUTAR TODA LA CLASE -----------------------------------

$baseUrl = 'https://api.vottun.tech';
$apiApp =''; 
$apiKey = '';
$network1 = 80001;
$erc20 = "";
$wallet = "";
$sdk = new VottunSDK($baseUrl, $apiApp, $apiKey);

try {
    
$resultado = $sdk->totalSupplyErc20($erc20, $network1);
// var_dump($resultado);
echo "<h2> --------Erc20------------ </h2>";
echo "<h3> -------- totalSupply ------------ </h3>";
echo "<li> El suministro total del token ERC-20 es: " . $resultado['totalSupply'];
echo "<p> ---------------------- </p>";

// balance
$resultado = $sdk->balanceOfErc20($erc20, $network1, $erc20);
// var_dump($resultado);
echo "<h3> -------- balanceOf ------------ </h3>";
echo "<li> El balance del token ERC-20 es: " . $resultado['balance'];
echo "<p> ---------------------- </p>";


//allowanceErc20($contractAddress, $network, $owner, $spender)
$resultado = $sdk->allowanceErc20($erc20, $network1, $wallet, $wallet);
// var_dump($resultado);
echo "<h3> -------- allowance ------------ </h3>";
echo "<li> El allowance del token ERC-20 es: " . $resultado['allowance'];
echo "<p> ---------------------- </p>";

//nameErc20
$resultado = $sdk->nameErc20($erc20, $network1);
// var_dump($resultado);
echo "<h3> -------- name ------------ </h3>";
echo "<li> El name del token ERC-20 es: " . $resultado['name'];
echo "<p> ---------------------- </p>";

//symbol
$resultado = $sdk->symbolErc20($erc20, $network1);
// var_dump($resultado);
echo "<h3> -------- symbol ------------ </h3>";
echo "<li> El symbol del token ERC-20 es: " . $resultado['symbol'];
echo "<p> ---------------------- </p>";

//decimals
$resultado = $sdk->decimalsErc20($erc20, $network1);
// var_dump($resultado);
echo "<h3> -------- decimals ------------ </h3>";
echo "<li> El decimal del token ERC-20 es: " . $resultado['decimals'];
echo "<p> ---------------------- </p>";

//transferErc20
// Arroja error si lo usamos muy seguido
$erc20Auxi= $erc20;
$walletAuxi = $wallet;
$networkauxi = $network1;
  // para usar se debe descomentar y colocar valores en: $name, $symbol , $alias, $amount y $gasLimit
/* $resultado = $sdk->transferErc20($erc20Auxi, $walletAuxi, $networkauxi, $amount, $gasLimit);
echo "<h2> -------->transfer------------ </h2>";
echo "<p> El transfer del token ERC-20 es: </p>";
echo "<li> txHash: " . $resultado['txHash'];
echo "<li> nonce: " . $resultado['nonce'];
echo "<p> ---------------------- </p>"; */


$name = "";
$symbol = "";
$alias = "";
$initialSupply = 1000000000000000000000000000;
$gasLimit = 6000000;
//deployErc20
  // para usar se debe descomentar y colocar valores en: $name, $symbol , $alias, $initialSupply y $gasLimit
  echo "<h3> -------- deploy ------------ </h3>";
  echo 'para usar se debe descomentar y colocar valores en: $name, $symbol , $alias, $initialSupply y $gasLimit';
  /* 
$resultado = $sdk->deployErc20($name, $symbol , $alias, $initialSupply, $networkauxi, $gasLimit);
echo "<p> El deploy del token ERC-20 es: </p>";
echo "<li> contractAddress: " . $resultado['contractAddress'];
echo "<li> txHash: " . $resultado['txHash'];
echo "<p> ---------------------- </p>"; */

 // transferFrom
  // para usar se debe descomentar y colocar valores en: $recipient, $amount, $gasLimit
  echo "<h3> -------- transferFrom ------------ </h3>";
  echo 'para usar se debe descomentar y colocar valores en: $recipient, $amount, $gasLimit';
  /*   $resultado = $sdk->transferFromErc20($erc20Auxi, $walletAuxi, $recipient, $networkauxi, $amount, $gasLimit);
 echo "<h2> --------transferFrom------------ </h2>";
 echo "<p> El transfer From del token ERC-20 es: </p>";
 echo "<li> txHash: " . $resultado['txHash'];
 echo "<li> nonce: " . $resultado['nonce'];
 echo "<p> ---------------------- </p>"; */

 // increaseAllowance
 // para usar se debe descomentar y colocar valores en:$gasLimit, $addedValue
 echo "<h3> -------- increaseAllowance ------------ </h3>";
 echo 'para usar se debe descomentar y colocar valores en: $gasLimit, $addedValue';
/* $resultado = $sdk->increaseAllowanceErc20($erc20Auxi, $walletAuxi, $networkauxi, $gasLimit, $addedValue);
 echo "<h2> --------increaseAllowance------------ </h2>";
 echo "<p> El increase Allowance del token ERC-20 es: </p>";
 echo "<li> txHash: " . $resultado['txHash'];
 echo "<li> nonce: " . $resultado['nonce'];
 echo "<p> ---------------------- </p>"; */

 // decreaseAllowance
 // para usar se debe descomentar y colocar valores en:$gasLimit, $subtractedValue
 echo "<h3> -------- decreaseAllowance ------------ </h3>";
 echo 'para usar se debe descomentar y colocar valores en: $gasLimit, $subtractedValue';
 /*  $resultado = $sdk->decreaseAllowanceErc20($erc20Auxi, $walletAuxi, $networkauxi, $gasLimit, $subtractedValue);
 echo "<h2> --------decreaseAllowance------------ </h2>";
 echo "<p> El decrease Allowance del token ERC-20 es: </p>";
 echo "<li> txHash: " . $resultado['txHash'];
 echo "<li> nonce: " . $resultado['nonce'];
 echo "<p> ---------------------- </p>"; */

/* ERC-721 */
$erc721 = "0xB5637fB016BB78d4486A115048bFbFe32bF1C022";

echo "<br><br><h2> --------Erc-721------------ </h2>";

// balance
$resultado = $sdk->balanceOfErc721($erc721, $network1, $erc721);
echo "<h3> -------- balanceOf ------------ </h3>";
echo "<li> El balance del token ERC-721 es: " . $resultado['balance'];
echo "<p> ---------------------- </p>";

//Token Uri
$resultado = $sdk->tokenUriErc721($erc721, $network1, 1);
echo "<h3> -------- tokenUri ------------ </h3>";
echo "<li> El tokenUri del token ERC-721 es: " . $resultado['uri'];
echo "<p> ---------------------- </p>";

//ownerOfErc721
$resultado = $sdk->ownerOfErc721($erc721, $network1, 1);
echo "<h3> -------- ownerOf ------------ </h3>";
echo "<li> El ownerOf del token ERC-721 es: " . $resultado['owner'];
echo "<p> ---------------------- </p>";

//deploy erc-721
// para usar se debe descomentar y colocar valores en: $name, $symbol , $alias y $gasLimit
echo "<h3> -------- deploy ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $name, $symbol , $alias y $gasLimit';
/*
$resultado = $sdk->deployErc721($name, $symbol, $networkauxi, $gasLimit, $alias);
echo "<p> El deploy del token ERC-721 es: </p>";
echo "<li> contractAddress: " . $resultado['contractAddress'];
echo "<li> txHash: " . $resultado['txHash'];
echo "<p> ---------------------- </p>";  */

//mint erc-721
// para usar se debe descomentar y colocar valores en: $tokenId, $ipfsUri, $ipfsHash, $royaltyPercentage y $gas
echo "<h3> -------- mint ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $tokenId, $ipfsUri, $ipfsHash, $royaltyPercentage y $gas';
/*
$resultado = $sdk->mintErc721($walletAuxi, $tokenId, $ipfsUri, $ipfsHash, $networkauxi, $erc721, $royaltyPercentage, $gas);
echo "<p> El mint del token ERC-721 es: </p>";
echo "<li> txHash: " . $resultado['txHash'];
echo "<li> nonce: " . $resultado['nonce'];
echo "<p> ---------------------- </p>";  */

//transfer erc-721
// para usar se debe descomentar y colocar valores en: $id, $erc721 y $walletAuxi
echo "<h3> -------- transfer ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $id, $erc721 y $walletAuxi';
/*
$resultado = $sdk->transferErc721($erc721, $networkauxi, $id, $erc721, $walletAuxi);
echo "<p> El transfer del token ERC-721 es: </p>";
echo "<li> txHash: " . $resultado['txHash'];
echo "<li> nonce: " . $resultado['nonce'];
echo "<p> ---------------------- </p>";  */


/* ERC-1155 */
$erc1155 = "0x4B40bdc8Ea252fD408Ce44Db4F3A14CC79748c9a";

echo "<br><br><h2> -------- Erc-1155 ------------ </h2>";

// balance
$resultado = $sdk->balanceOfErc1155($erc1155, $networkauxi, $erc1155, 1);
echo "<h3> -------- balanceOf ------------ </h3>";
echo "<li> El balance del token ERC-1155 es: " . $resultado['balance'];
echo "<p> ---------------------- </p>";

//Token Uri
$resultado = $sdk->tokenUriErc1155($erc1155, $network1, 1);
echo "<h3> -------- tokenUri ------------ </h3>";
echo "<li> El tokenUri del token ERC-1155 es: " . $resultado['uri'];
echo "<p> ---------------------- </p>";

//deploy erc-1155
// para usar se debe descomentar y colocar valores en: $name, $symbol, $ipfsUri, $royaltyRecipient, $royaltyValue, $gasLimit y $alias
echo "<h3> -------- deploy ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $name, $symbol, $ipfsUri, $royaltyRecipient, $royaltyValue, $gasLimit y $alias';
/*
$resultado = $sdk->deployEr1155($name, $symbol, $ipfsUri, $royaltyRecipient, $royaltyValue, $networkauxi, $gasLimit, $alias);
echo "<p> El deploy del token ERC-1155 es: </p>";
echo "<li> contractAddress: " . $resultado['contractAddress'];
echo "<li> txHash: " . $resultado['txHash'];
echo "<p> ---------------------- </p>";  */ 

//mint erc-1155
// para usar se debe descomentar y colocar valores en: $to, $id y $amount
echo "<h3> -------- mint ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $to, $id y $amount';
/*
$resultado = $sdk->mintErc1155($erc1155, $networkauxi, $to, $id, $amount);
echo "<p> El mint del token ERC-1155 es: </p>";
echo "<li> txHash: " . $resultado['txHash'];
echo "<li> nonce: " . $resultado['nonce'];
echo "<p> ---------------------- </p>";  */

//transfer erc-1155
echo "<h3> -------- transfer ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $to, $id y $amount';
/*
$resultado = $sdk->transferErc1155($erc1155, $networkauxi, $to, $id, $amount);
echo "<p> El transfer del token ERC-1155 es: </p>";
echo "<li> txHash: " . $resultado['txHash'];
echo "<li> nonce: " . $resultado['nonce'];
echo "<p> ---------------------- </p>";  */

/* Custodied Wallets */
$cwll = "0x50a8Bd0C1034717DF5D96159589302eC1bDcBB07";
$callbackUrl = "https://callback.vottun.tech/rest/v1/success/";
$fallbackUrl = "https://fallback.vottun.tech/rest/v1/error/";
$cancelUrl = "https://fallback.vottun.tech/rest/v1/cancel/";
$strategies = [2,3];
$userEmail = 'jtrm.trading@gmail.com';
//Get New Hash
echo "<br><br><h2> -------- Custodied Wallets ------------ </h2>";
echo "<h3> -------- Get New Hash ------------ </h3>";
echo 'para usar se debe descomentar y colocar valores en: $username';
 /*
$resultado = $sdk->newHashCwll($username, $strategies, $callbackUrl, $fallbackUrl, $cancelUrl);
echo "<p> El Get New Hash de Custodied Wallets es: </p>";
echo "<li> hash: " . $resultado['hash'];
echo "<li> expirationTime: " . $resultado['expirationTime'];
echo "<p> ---------------------- </p>"; */

//Get Custodied Wallet Address
echo "<h3> -------- Get Custodied Wallet Address ------------ </h3>";

$resultado = $sdk->addressCwll($userEmail);
echo "<p> El Get Custodied Wallet Address es: </p>";
echo "<li> accountAddress: " . $resultado['accountAddress'];
echo "<li> strategy: " . $resultado['strategy'];
echo "<p> ---------------------- </p>";  

//Get Customer Custodied Wallets
echo "<h3> -------- list Custodied Wallet Address ------------ </h3>";

$resultado = $sdk->listCwll();
echo "<p> El listado de Custodied Wallet Address es: </p>";
echo "<li> id: " . $resultado[0]['id'];
echo "<li> strategy: " . $resultado[0]['strategy'];
echo "<li> userEmail: " . $resultado[0]['userEmail'];
echo "<li> accountHash: " . $resultado[0]['accountHash'];
echo "<li> creationTimestamp: " . $resultado[0]['creationTimestamp'];
echo "<p> ---------------------- </p>";  


} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>


