<?php
namespace SvyaznoyApi\Http;

class Headers
{

    /** @var Header[] $headers */
    private $headers = [];

    /**
     * @param Header $header
     */
    public function add(Header $header): void
    {
        $this->headers[$header->getName()] = $header;
    }

    /**
     * @param string $name
     * @return null|Header
     */
    public function get(string $name)
    {
        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }
        return null;
    }

    /**
     * @return Header[]
     */
    public function getAll(): array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->headers[$name]);
    }

    /**
     * @param string $name
     */
    public function remove(string $name): void
    {
        if (isset($this->headers[$name])) {
            unset($this->headers[$name]);
        }
    }

    public function getHttpArray(): array
    {
        $result = [];
        foreach ($this->getAll() as $header) {
            foreach ($header->getValues() as $value) {
                $result[$header->getName()] = $value;
            }
        }
        return $result;
    }

}