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
}