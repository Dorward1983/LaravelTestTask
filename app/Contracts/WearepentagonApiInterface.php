<?php

namespace App\Contracts;

interface WearepentagonApiInterface
{
    /**
     * @param array $data
     * @return WearepentagonApiInterface
     */
    public static function saveFromApi(array $data): WearepentagonApiInterface;
}
