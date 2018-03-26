<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Entity
{
    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);

            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }
}
