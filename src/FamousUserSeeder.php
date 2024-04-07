<?php

namespace Cornelisonc\FamousUserSeeder;

use Illuminate\Support\Facades\Hash;

abstract class FamousUserSeeder
{
    private $data;

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

                $nodeElement[$key] = $this->$field($node);
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
