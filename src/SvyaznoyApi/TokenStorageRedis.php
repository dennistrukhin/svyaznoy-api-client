<?php
namespace SvyaznoyApi;

class TokenStorageRedis implements ITokenStorage
{

    const REDIS_TOKEN_KEY = 'svyaznoy_client_access_token';

    /** @var \Redis $redis */
    private $redis;

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    public function exists()
    {
        return $this->redis->exists(self::REDIS_TOKEN_KEY);
    }

    public function get()
    {
        return $this->redis->get(self::REDIS_TOKEN_KEY);
    }

    public function save($token, $ttl = 36000)
    {
        if ($ttl == 0) {
            return $this->redis->set(self::REDIS_TOKEN_KEY, $token);
        } else {
            return $this->redis->setex(self::REDIS_TOKEN_KEY, $ttl, $token);
        }
    }

}