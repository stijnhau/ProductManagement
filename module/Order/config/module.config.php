<?php
namespace Order;

use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'factories' => array(
            'Order\Controller\Order' => 'Order\Controller\Factory\OrderController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'order' => array(
                'type'    => Segment::class,
                'options' => array(
                    'route'    => '/order[/][:action][/][:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Order\Controller\Order',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Order' => __DIR__ . '/../view',
        ),
    ),
);
