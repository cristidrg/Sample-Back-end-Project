<?php
namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SiteImproveService
{
    protected $key;
    protected $user;
    protected $httpClient;

    public function __construct(String $user, String $key)
    {
        $this->user = $user;
        $this->key = $key;
        $this->httpClient = new Client();
    }

    public function getSites()
    {
        if (!isset($this->key)) {
            throw "Key is not provided to Site Improve Service";
        }

        $sites = [];

        $res = $this->httpClient->request('GET', 'https://api.siteimprove.com/v2/sites', [
            'auth' => [$this->user, $this->key],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'query' => [
                'page_size' => 1000
            ]
        ]);


        $jsonRes = json_decode($res->getBody()->getContents(), true);
        
        if ($jsonRes['total_pages'] > 1000) {
            throw new Exception('The Site Improve Service needs to have its code updated to support pagination');
        }

        foreach ($jsonRes['items'] as $site) {
            array_push($sites, [
                'siteImproveId' => $site['id'],
                'url' => $site['url'],
                'name' => $site['site_name']
            ]); 
        }
        

        dd($sites);

        return [];
    }
}