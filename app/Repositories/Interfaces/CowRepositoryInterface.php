<?php

namespace App\Repositories\Interfaces;

interface CowRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null);

    public function getCowByWhere(array $where);

    public function createOrUpdateSoldCow(array $data, string $id = null);

    public function createOrUpdateDeadCow(array $data, string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where);

    public function getAllDeadCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null , array $where);

    public function getAllSoldCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null , array $where);

    public function getAllDeleteCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where);
}
