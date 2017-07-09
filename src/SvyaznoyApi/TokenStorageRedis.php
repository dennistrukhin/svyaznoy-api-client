<?php
namespace SvyaznoyApi;

class TokenStorageRedis implements ITokenStorage
{

    /** @var \Redis $redis */
    private $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function exists()
    {
        return $this->redis->exists('svyaznoy_access_token');
    }

    public function get()
    {
        return $this->redis->get('svyaznoy_access_token');
    }

    public function save($token, $ttl = 36000)
    {
        if ($ttl == 0) {
            return $this->redis->set('svyaznoy_access_token', $token);
        } else {
            return $this->redis->setex('svyaznoy_access_token', $ttl, $token);
        }
    }

}