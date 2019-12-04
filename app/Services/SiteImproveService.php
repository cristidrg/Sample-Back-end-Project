<?php
namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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

        // Get the list of all the websites
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
        
        // TODO: Change logic to batch
        if ($jsonRes['total_pages'] > 1000) {
            throw new Exception('The Site Improve Service needs to have its code updated to support pagination');
        }


        foreach ($jsonRes['items'] as $site) {
            $sites[$site['id']] = [
                'siteImproveId' => $site['id'],
                'url' => $site['url'],
                'title' => $site['site_name']
            ];
        }
        
        // Create requests to get site scores
        foreach ($sites as $site) {
            $requests[] = new Request('GET', 'https://api.siteimprove.com/v2/sites/' . $site['siteImproveId'] . '/dci/overview', [
                'Authorization' => 'Basic '. base64_encode($this->user.':'.$this->key),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]);
        }
    
        $responses = [];
        
        while(count($requests) > 0) {

            // Create batch 50 requests every 10 seconds to respect Site Improves API's rate limiter
            foreach (Pool::batch($this->httpClient, array_splice($requests, 0, 49), array('concurrency' => 50)) as $response) {
                if (get_class($response) == 'GuzzleHttp\Exception\ClientException') {
                    array_push($requests, new Request('GET', 'https://api.siteimprove.com' . $response->getRequest()->getUri()->getPath(), [
                        'Authorization' => 'Basic '. base64_encode($this->user.':'.$this->key),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json'
                        ],
                    ]));

                    continue;
                }

                $resAsJson = json_decode($response->getBody()->getContents(), true);

                $resUrl = explode('/', $resAsJson['_links']['self']['href']);
                $resID = $resUrl[count($resUrl) - 3];
                
                $sites[$resID]['a11yScore'] = $resAsJson['accessibility']['total'];
                $sites[$resID]['seoScore'] = $resAsJson['seo']['total'];
                $sites[$resID]['qaScore'] = $resAsJson['qa']['total'];
            }

            sleep(10);
        }

        return $sites;
    }
}