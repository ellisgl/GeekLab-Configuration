<?php

use GeekLab\Conf\Driver\YAMLConfDriver;
use PHPUnit\Framework\TestCase;

class YAMLConfDriverTest extends TestCase
{
    public function testDriver(): void
    {
        // Where the configurations are.
        $confDir = __DIR__ . '/../_data/YAML/';
        $driver                 = new YAMLConfDriver($confDir . 'system.yaml', $confDir);

        $expected = [
            'service' => 'CrazyWebApp',
            'env'     => 'dev',
            'conf'    =>
                [
                    'webapp',
                    'dev',
                    'ellisgl'
                ]
        ];

        $this->assertSame($expected, $driver->parseConfigurationFile());

        $expected = [
            'outofsection' => 456,
            'database' =>
                [
                    'dsn'  => 'mysql:host=@[database.host];dbname=@[database.db]',
                    'host' => 'localhost',
                    'user' => 'dev',
                    'pass' => 'devpass',
                    'db'   => 'GeekLab'
                ],
            'devstuff' =>
                [
                    'x' => 'something'
                ]
        ];

        $this->assertSame($expected, $driver->parseConfigurationFile('dev'));
    }
}
