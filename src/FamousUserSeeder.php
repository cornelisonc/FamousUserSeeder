<?php

namespace Cornelisonc\FamousUserSeeder;

abstract class FamousUserSeeder
{
    private $data;

    public function __construct()
    {
        echo 'FamousUserSeeder';
    }

    public function firstName($node)
    {
        return $node['first'];
    }

    public function lastName($node)
    {
        return $node['last'];
    }

    public function fullName($node)
    {
        return $node['first'] . ' ' . $node['last'];
    }

    public function email($node)
    {
        return strtolower(sprintf(
            '%s.%s@users.com',
            preg_replace("/[^A-Z]+/", "", $node['first']),
            preg_replace("/[^A-Z]+/", "", $node['last'])
        ));
    }
}
