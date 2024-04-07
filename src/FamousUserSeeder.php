<?php

namespace Cornelisonc\FamousUserSeeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

abstract class FamousUserSeeder
{
    protected $data;

    public function __construct()
    {
        echo 'FamousUserSeeder';
    }

    /**
     * @param int $quantity
     *
     * @param array $fields
     * $fields = [
     *      'firstName',
     *      'lastName',
     *      'fullName,
     * ];
     *
     * @return array
     */
    public function get($quantity = 1, $fields = [])
    {
        $filtered = [];

        while (sizeof($filtered) < $quantity) {
            shuffle($this->data);

            if (sizeof($this->data) >= $quantity) {
                $filtered = array_slice($this->data, 0, $quantity);
            } else {
                $filtered = array_push($out, $this->data);
            }
        }

        foreach ($filtered as $node) {
            $nodeElement = [];

            foreach ($fields as $alias => $field) {
                $key = is_string($alias) ? $alias : $field;

                if (method_exists($this, $field)) {
                    $nodeElement[$key] = $this->$field($node);
                } else {
                    // Key function does not exist, return random
                    // @TODO: allow aliased field names and types,
                    // eg string int &c
                    $nodeElement[$key] = Str::random(10);
                }
            }

            $out[] = $nodeElement;
        }

        return $out;
    }

    protected function firstName($node)
    {
        return $node['first'];
    }

    protected function lastName($node)
    {
        return $node['last'];
    }

    protected function fullName($node)
    {
        return $node['first'] . ' ' . $node['last'];
    }

    protected function email($node)
    {
        return strtolower(sprintf(
            '%s.%s@users.com',
            preg_replace('/[^\da-z]/i', '', $node['first']),
            preg_replace('/[^\da-z]/i', '', $node['last']),
        ));
    }

    protected function password($node)
    {
        return Hash::make($node['first'] . ' ' . $node['last']);
    }
}
