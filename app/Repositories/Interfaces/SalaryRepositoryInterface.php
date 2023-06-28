<?php

namespace App\Repositories\Interfaces;

interface SalaryRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function getAllSalaryByFarmer(array $with = [], array $filter = []);
}
