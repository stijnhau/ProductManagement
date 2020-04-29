<?php
namespace Allergenen\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Allergenen\Controller\AllergenenController as controller;

class AllergenenController implements FactoryInterface
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
