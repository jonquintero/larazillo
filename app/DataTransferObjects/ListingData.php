<?php

namespace App\DataTransferObjects;

class ListingData
{
    public function __construct(public readonly int $beds,
        public readonly int $baths,
        public readonly int $area,
        public readonly string $city,
        public readonly string $street,
        public readonly string $street_nr,
        public readonly string $code,
        public readonly int $price)
    {

    }
}
