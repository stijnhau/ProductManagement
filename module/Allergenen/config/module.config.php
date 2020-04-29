<?php
namespace Application;

use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'factories' => array(
            'Allergenen\Controller\Allergenen' => 'Allergenen\Controller\Factory\AllergenenController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'allergenen' => array(
                'type'    => Segment::class,
                'options' => array(
                    'route'    => '/allergen[/][:action][/][:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Allergenen\Controller\Allergenen',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Allergenen' => __DIR__ . '/../view',
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
);
