<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'user' => 'admin_vps',
                    'password' => 'wf25TLja',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'dbname' => 'admin_productManagement',
                ),
            ),
        )
    )
);
