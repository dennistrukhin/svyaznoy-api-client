<?php
namespace SvyaznoyApi\TokenStorage;

class TokenStorageMemory implements TokenStorageInterface
{

    private $token = false;
    private $expire = 0;

    public function exists()
    {
        if ($this->token === false) {
            return false;
        }
        if ($this->expired()) {
            return false;
        }
        return true;
    }

    public function get()
    {
        if ($this->expired()) {
            return false;
        }
        return $this->token;
    }

    public function save($token, $ttl = 36000)
    {
        $this->token = $token;
        $this->expire = time() + $ttl;
    }

    private function expired()
    {
        return $this->expire > 0 && $this->expire < time();
    }
}