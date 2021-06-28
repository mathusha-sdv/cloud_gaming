<?php
namespace App\Client;
use TheNetworg\OAuth2\Client\Provider\Azure;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AzureClient
 *
 * @author mtmat
 */
class AzureClient {
    
    const ACTION_START = 'start';
    const ACTION_STOP = 'stop';

    private $azureLogin;
    private $azureApi;
    
    public function __construct(HttpClientInterface $azureLogin, HttpClientInterface $azureApi) 
    {
        $this->azureLogin = $azureLogin;
        $this->azureApi = $azureApi;
    }
    
    public function getConnection()
    {
        $tenantID = 'b7b023b8-7c32-4c02-92a6-c8cdaa1d189c';
         $response = $this->azureLogin->request(
                'POST',
                '/'.$tenantID.'/oauth2/token',
                [
                    'body' => [
                        'grant_type' => 'client_credentials',
                        'client_id' => '579a538f-85d1-4327-871d-43ab46bc363f',
                        'client_secret'=>'fS-t~5qv~0x8Bf0qpdlexJ6L6gIdGzB3DC',
                        'resource'=>'https://management.azure.com/'
                    ]
                ]
            );
         return $response->toArray();
    }
    
    public function getToken()
    {
        $response = $this->getConnection();
        return $response['access_token'];
    }
    
    public function executeAction($action)
    {
        $response = $this->azureApi->request(
                'POST',
                '/subscriptions/bb8f88c1-0d2d-4e9c-a732-3ecadfdeed9a/resourceGroups/NetworkWatcherRG/providers/Microsoft.Web/sites/UnityTourellle/'.$action.'?api-version=2019-08-01',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->getToken(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
        if($response->getStatusCode() >= 400) {
            throw new Exception('Erreur' . $response->getContent());
        }
       // https://management.azure.com/subscriptions/bb8f88c1-0d2d-4e9c-a732-3ecadfdeed9a/resourceGroups/NetworkWatcherRG/providers/Microsoft.Web/sites/UnityTourellle/stop?api-version=2019-08-01
    }
    
    public function startServer()
    {
        $this->executeAction('start');
    }
}
