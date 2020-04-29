<?php
namespace Customer;

use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'factories' => array(
            'Customer\Controller\Customer' => 'Customer\Controller\Factory\CustomerController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'customer' => array(
                'type'    => Segment::class,
                'options' => array(
                    'route'    => '/customer[/][:action][/][:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Customer\Controller\Customer',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Customer' => __DIR__ . '/../view',
        ),
    ),
);
