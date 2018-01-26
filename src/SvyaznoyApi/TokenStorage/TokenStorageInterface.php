<?php
namespace SvyaznoyApi\TokenStorage;

interface TokenStorageInterface
{

    public function exists();
    public function get();
    public function save($token, $ttl = 36000);

}