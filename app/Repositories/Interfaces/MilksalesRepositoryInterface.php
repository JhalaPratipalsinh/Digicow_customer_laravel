<?php

namespace App\Repositories\Interfaces;

interface MilksalesRepositoryInterface
{
    public function createOrUpdate(array $data , string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function getAllSalesMilkReport(array $filter = []);

    public function getAllMilkSalesByFarmer(array $with = [],array $filter = []);
}
