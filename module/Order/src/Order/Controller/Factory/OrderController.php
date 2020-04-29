<?php
namespace Order\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Order\Controller\OrderController as controller;

class OrderController implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new controller();
        $controller->setEntityManager($container->get('doctrine.entitymanager.orm_default'));
        $controller->setTranslate($container->get('ViewHelperManager')->get('translate'));
        return $controller;
    }
}
