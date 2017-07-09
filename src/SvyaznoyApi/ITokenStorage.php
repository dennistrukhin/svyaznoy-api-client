<?php
namespace SvyaznoyApi;

interface ITokenStorage
{

    public function exists();
    public function get();
    public function save($token, $ttl = 36000);



}