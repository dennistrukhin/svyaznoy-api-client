<?php
namespace SvyaznoyApi;

class TokenStorageMemory implements ITokenStorage
{

    private $token = null;
    private $expire = 0;

    public function exists()
    {
        if (is_null($this->token)) {
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
            return null;
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