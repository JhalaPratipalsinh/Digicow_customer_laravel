<?php

namespace App\Repositories\Interfaces;

interface BreedingRepositoryInterface
{
    public function getTotalBreeding(array $filter = []);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function createOrUpdate(array $data, string $id = null);

    public function getTotalBreedingAmount(array $filter = []);

    public function getAllBreedingfByFarmer(array $with = [], array $filter = []);

    public function updateBreedingbyVet(array $breeding_health_update = [], string $vet_id = null);

    public function getPaidBreedingList(array $filter = []);

    public function getBreeding(string $id);

    public function getHieghestRepeatAI(array $where = []);
}
