<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return [
    'navigation' => [

        // navigation with name default
        'default' => [
        ],
    ],

    'db' => array(
        'driver'    => 'Pdo',
        'hostname'  => '127.0.0.1',
        'database'  => 'admin_productManagement',
        'username'  => 'admin_vps',
        'password'  => 'wf25TLja',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
];
