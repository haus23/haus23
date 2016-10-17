<?php

namespace AppBundle\Entity;

/**
 * Config
 */
class Config
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $key;


    /**
     * Set value
     *
     * @param string $value
     *
     * @return Config
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
