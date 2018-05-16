<?php

namespace Blog\Entity;

use Blog\Exceptions\ResourceNotFoundException;

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
            if (preg_match('/^[a-z]+_[a-z]+$/i', $key)) {
                $key = str_replace('_', '', ucwords($key, '_'));
            }

            if($key === 'UpdatedAt' || $key === 'PostedAt')
            {
                $value = new \DateTime($value);
            }

            $setterName = 'set' . ucfirst($key);

            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }
}
