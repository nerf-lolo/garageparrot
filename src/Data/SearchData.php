<?php

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var null|integer
     */
    public $minPrice;

    /**
     * @var null|integer
     */
    public $maxPrice;

    /**
     *@var null|integer
     */
    public $minYear;

    /**
     * @var null|integer
     */
    public $maxYear;

    /**
     * @var null|integer
     */
    public $minKm;

    /**
     * @var null|integer
     */
    public $maxKm;
}
