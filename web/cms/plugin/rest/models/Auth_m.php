<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_m extends GW_Model
{
    public function login($username, $password)
    {
        $condition = [
            'username' => $username,
            'password' => $password,
        ];

        $user = $this->db
            ->get_where('users', $condition)
            ->row();
        return $user;
    }
}
