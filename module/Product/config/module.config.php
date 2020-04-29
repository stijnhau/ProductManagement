<?php
namespace Application;

use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'factories' => array(
            'Product\Controller\Product' => 'Product\Controller\Factory\ProductController',
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'router' => array(
         'routes' => array(
             'product' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/product[/][:action][/][:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Product\Controller\Product',
                     ),
                 ),
             ),
         ),
     ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Product' => __DIR__ . '/../view',
        ),
    ),
);
