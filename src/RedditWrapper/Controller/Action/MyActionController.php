<?php

namespace RedditWrapper\Controller\Action;

/**
 * Created by PhpStorm.
 * User: abdullah.s
 * Date: 11/2/2017
 * Time: 12:01 PM
 */


use RedditWrapper\Service\RedditPageService;
use Zend\Mvc\Controller\AbstractActionController;


class MyActionController  extends AbstractActionController
{
    public $RedditPageService;

    /**
     * MyActionController constructor.
     * @param $RedditPageService
     */
    public function __construct(RedditPageService $RedditPageService)
    {
        $this->RedditPageService = $RedditPageService;
    }

    public function getNewFeedsAction(){
        try{
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine( 'Content-Type', 'application/json' );

            $url = 'https://www.reddit.com/new';
            $before = $this->params()->fromQuery('before');
            $after =  $this->params()->fromQuery('after');

            $data = $this->RedditPageService->getPage($url,$before,$after);
            $response->setContent(json_encode($data));
            return $response;
        }
        catch (\Exception $e){
            $response->setContent(json_encode([
                'error' => true,
                'error_message' => 'Error while getting new feeds from reddit: '. $e->getMessage(),
            ]));
            return $response;
        }
    }

    public function getHotFeedsAction(){
        try{
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine( 'Content-Type', 'application/json' );

            $url = 'https://www.reddit.com/';
            $before = $this->params()->fromQuery('before');
            $after =  $this->params()->fromQuery('after');

            $data = $this->RedditPageService->getPage($url,$before,$after);
            $response->setContent(json_encode($data));
            return $response;
        }
        catch (\Exception $e){
            $response->setContent(json_encode([
                'error' => true,
                'error_message' => 'Error while getting new feeds from reddit: '. $e->getMessage(),
            ]));
            return $response;
        }
    }

}