<?php
require_once 'vendor/autoload.php';

use Karson\MpesaPhpSdk\Mpesa;

class Payment
{

    function pay($phone_number, $amount, $reference_id)
    {
        // Set the api and public key as follows . Copy it from Mpesa Developer Console (https://developer.mpesa.vm.co.mz/) .
        $mpesa = new Mpesa();
        $mpesa->setApiKey('aor6nzx9goh9pbj83h4qcyocie93t4qk');
        $mpesa->setPublicKey('MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==');
        $mpesa->setServiceProviderCode('171717');
        $mpesa->setEnv('test'); // 'live' production environment 
        $invoice_id = "FT0001"; // Eg: Invoice number
        $result = $mpesa->c2b($invoice_id, $phone_number, $amount, $reference_id);
       //  var_dump($result);
         $status = $result->status;
         return $status;
    }
}


/*


$payment = new Payment();

var_dump($_POST);
 $phone_number = "258".$_POST['celular']; // Prefixed with country code (258)
$amount = $_POST['valor']; // Payment amount
$reference_id = $_POST['referencia'];

$result = $payment->pay($phone_number, $amount, $reference_id);
if($result==200 or $result==201){
    echo "<p style='color: green; padding: 10px'>Pagamento efectuado com sucesso!</p>";
}else{
    echo "<p style='color: red; padding: 10px'>Erro ao efectuar o pagamento!</p>";

}
*/