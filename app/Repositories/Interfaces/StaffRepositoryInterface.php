<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null);

    public function checkMobileAvailable(string $staff_mobile_number = null, string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);
}
