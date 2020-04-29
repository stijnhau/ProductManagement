<?php
namespace Application\Navigation;

use Zend\Navigation\Service\DefaultNavigationFactory;
use Interop\Container\ContainerInterface;

class MyNavigationFactory extends DefaultNavigationFactory
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'main';
    }

    protected function getPages(ContainerInterface $container)
    {
        if (null === $this->pages) {
            //FETCH data from table menu :
            $authorize = $container->get('BjyAuthorize\Provider\Identity\ProviderInterface');
            $roles = $authorize->getIdentityRoles();

            $rolesArr = array(null);
            foreach ($roles as $role) {
                $em = $container->get('doctrine.entitymanager.orm_default');
                /* @var $data \Application\Entity\UserRole */
                $data = $em->getRepository('Application\Entity\UserRole')->findBy(array('roleId' => $role));

                $rolesArr = array_merge($rolesArr, $data[0]->getIdArray());
            }

            $configuration['navigation'][$this->getName()] = array();
            foreach ($rolesArr as $role) {
                $data = $em->getRepository('Application\Entity\Navigation')->findBy(
                    array('parent' => null, 'userRole' => $role)
                );

                foreach ($data as $menu) {
                    /* @var $menu \Application\Entity\Menu */

                    $pages = array();
                    $dataParent = $em->getRepository('Application\Entity\Navigation')->findBy(array('parent' => $menu));
                    foreach ($dataParent as $elem) {
                        /* @var $elem \Application\Entity\Navigation */

                        $pages[] =  array(
                            'label' => $elem->getLabel(),
                            'route' => $elem->getRoute(),
                            'action' => $elem->getAction(),
                        );
                    }

                    $configuration['navigation'][$this->getName()][$menu->getName()] = array(
                        'label' => $menu->getLabel(),
                        'route' => $menu->getRoute(),
                        'action' => $menu->getAction(),
                        'pages' => $pages,
                    );
                }
            }

            if (!isset($configuration['navigation'])) {
                throw new Exception\InvalidArgumentException('Could not find navigation configuration key');
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Failed to find a navigation container by the name "%s"',
                    $this->getName()
                ));
            }

            $application = $container->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);

            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }

        return $this->pages;
    }
}
