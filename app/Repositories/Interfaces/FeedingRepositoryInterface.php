<?php

namespace App\Repositories\Interfaces;

interface FeedingRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function getCount(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function getAllFeedingByFarmer(array $with = [], array $filter = []);
}
