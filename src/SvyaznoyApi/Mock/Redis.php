<?php
namespace SvyaznoyApi\Mock;

class Redis
{

    private $storage = [];
    private $ttl = [];

    public function exists($key)
    {
        return isset($this->storage[$key]);
    }

    public function get($key)
    {
        return $this->storage[$key] ?? false;
    }

    public function set($key, $value)
    {
        $this->storage[$key] = $value;
    }

    public function setex($key, $ttl, $value)
    {
        $this->storage[$key] = $value;
        $this->ttl[$key] = time() + $ttl;
    }

}