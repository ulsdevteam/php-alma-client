<?php

namespace Scriptotek\Alma;

trait ArrayAccessResource
{
    public function offsetSet($offset, $value)
    {
        throw \Exception('Not implemented');
    }

    public function offsetUnset($offset)
    {
        throw \Exception('Not implemented');
    }

    public function offsetExists($offset)
    {
        return $this->get($offset)->exists();
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
}
