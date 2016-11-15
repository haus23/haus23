<?php

namespace AppBundle\MessageBus\Query;

class GetChampionshipBySlug
{
    /** @var string */
    private $slug;

    /**
     * GetChampionshipBySlug constructor.
     *
     * @param string $slug
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }
}