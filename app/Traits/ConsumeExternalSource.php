<?php


namespace App\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

trait ConsumeExternalSource
{

     public function performRequest($method, $requestUrl)
    {
        $client = new Client(); //GuzzleHttp\Client
        $headers = ['Accept' => 'application/vnd.api+json'];
        $api_url = $this->baseUri . ''.$requestUrl ;

        try {
            $response = $client->request ($method, $api_url, [
                 'headers' => $headers
            ]);
            return json_decode($response->getBody(),true);
        }catch (\Exception $e){
          Log::error("Exception: ".$e->getMessage());
        }

    }
    public function performCustomRequest($method, $requestUrl)
    {
        $client = new Client(); //GuzzleHttp\Client
        $headers = ['Accept' => 'application/vnd.api+json'];
        $api_url = $requestUrl;

        try {
            $response = $client->request ($method, $api_url, [
                 'headers' => $headers
            ]);
            return json_decode($response->getBody(),true);
        }catch (\Exception $e){
          Log::error("Exception: ".$e->getMessage());
        }

    }

}
