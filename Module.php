<?php
namespace RedditWrapper;

use RedditWrapper\Service\RedditPageService;
use RedditWrapper\Controller\Action\MyActionController;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @author Abdullah Omar Siraj <abdullah.s@digitalroominc.com>
 * 8/3/2017
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'RedditWrapper\Service\RedditPageService' => function ($sm) {
                    return new RedditPageService();
                },
            )
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'RedditWrapper\Controller\Action\MyAction' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $RedditPageService = $locator->get('RedditWrapper\Service\RedditPageService');
                    return new MyActionController($RedditPageService);
                },
            ),
        );
    }
}