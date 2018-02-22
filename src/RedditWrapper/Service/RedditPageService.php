<?php
/**
 * Created by PhpStorm.
 * User: abdullah.s
 * Date: 2/21/2018
 * Time: 3:47 PM
 */

namespace RedditWrapper\Service;


use Zend\Http\Client;

class RedditPageService
{
    public function getPage($url, $before, $after, $count = 25){
        $urlJson = $this->ReConstructURL($url);

        $params = [];
        if ($before != null){
            $params = $this->ReConstructParams('before', $before, $count);
        }
        else if($after != null){
            $params = $this->ReConstructParams('after',$after, $count);
        }

        return $this->get($urlJson, $params, null);
    }

    public function ReConstructParams($pageDirection, $pageID, $count) {
        return [
            $pageDirection => $pageID,
            'count' => $count
        ];
    }

    private function ReConstructURL($url){
        return $url.'.json';
    }

    public function get($uri, $params = array(), $header = null)
    {
        if ($header == null)
            $header = $this->getHeader();

        $client = new Client($uri);
        $client->setUri($uri);
        $client->setHeaders($header);
        $client->setParameterGet($params);
        $response = $client->send();
        if ($response->isSuccess()) {
            $decodedResponse = json_decode($response->getBody(), true);;
            return $decodedResponse;
        } else
            return null;

    }

    public function getHeader(){
        return [
            'Content-Type' => 'application/json'
        ];
    }
}