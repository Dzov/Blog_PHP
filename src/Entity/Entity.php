<?php

namespace Blog\Entity;

use Blog\Exception\ResourceNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Entity
{
    public function __construct($data = [])
    {
        if (false === $data) {
            throw new ResourceNotFoundException();
        }
        $this->hydrate($data);
    }

    protected function hydrate(array $data = []): void
    {
        foreach ($data as $key => $value) {
            $key = str_replace('_', '', ucwords($key, '_'));

            if ($key === 'UpdatedAt' || $key === 'PostedAt') {
                $value = new \DateTime($value);
            }

            $setterName = 'set' . ucfirst($key);

            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }
}
