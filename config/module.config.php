<?php
return array(
    'router' => array(
        'routes' => array(
            'get-new-feeds' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/get-new-feeds',
                    'defaults' => array(
                        'controller' => 'RedditWrapper\Controller\Action\MyAction',
                        'action'     => 'getNewFeeds',
                    )
                )
            ),
            'get-hot-feeds' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/get-hot-feeds',
                    'defaults' => array(
                        'controller' => 'RedditWrapper\Controller\Action\MyAction',
                        'action'     => 'getHotFeeds',
                    )
                )
            ),
        ),
    ),
);