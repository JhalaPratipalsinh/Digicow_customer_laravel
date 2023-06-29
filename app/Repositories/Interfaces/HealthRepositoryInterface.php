<?php

namespace App\Repositories\Interfaces;

interface HealthRepositoryInterface
{
    public function getTotalHealth(array $filter = []);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function createOrUpdate(array $data, string $id = null);

    public function getTotalHealthAmount(array $filter = []);

    public function getAllHealthByFarmer(array $with = [], array $filter = []);

    public function updateHealthbyVet(array $breeding_health_update = [], string $vet_id = null);

    public function getPaidHealthList(array $filter = []);

    public function destroy(string $treantment_id);

    public function getHieghestHealthExpense(array $where = []);
}
