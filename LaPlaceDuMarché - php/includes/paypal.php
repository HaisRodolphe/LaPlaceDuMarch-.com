<?php

class Paypal{

    private $user = '';
    private $pwd = '';
    private $signature = '';
    public $endpoint = '';
    public $errors = array();

    public function __construct($user = false, $pwd = false, $signature = false, $prod = false){

        if($user){

            $user = $this->user;
        }
        if($pwd){

            $pwd = $this->pwd;
        }
        if($signature){

            $signature = $this->signature;
        }
        if($prod){

            $this->endpoint = str_replace('sandbox.', '', $this->endpoint);
        }
        
        public function request($method, $params){

            $params = array_merge($params, array(
                'METHOD' => $method;
                'VERSION' => '';
                'USER' => $this->user;
                'PWD' => $this->pwd;
                'SIGNATURE' => $this->signature;

            ));
        
            $params = http_build_query($params);

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => $this->endpoint,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_VERBOSE => 1,

            ));
           
            $response = curl_exec($curl);
            parse_str($reponse, $responseArray);

            if(curl_error($curl)){

                $this->errors = curl_error($curl);
                curl_close($curl);
                return false;

            }else{

                if($responseArray['ACK'] == 'Success'){

                    curl_close($curl);
                    return $responseArray;

                }else{


                    $this->errors = curl_error($curl);
                    curl_close($curl);
                    return false;

                }
                
            }


        }
    }
}
?>