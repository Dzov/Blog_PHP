<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Entity
{
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);

            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }
}
