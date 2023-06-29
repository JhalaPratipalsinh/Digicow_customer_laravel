<?php

namespace App\Repositories\Interfaces;

interface MilkProductionRepositortInterface
{
    public function createOrUpdate(array $data, string $id = null);

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []);

    public function getAllMilkProductionReport(array $filter = []);

    public function getHieghestmilkProducer(array $where = []);

    public function getLowestmilkProducer(array $where = []);

    public function getTotalProductionofToday(array $where = []);

    public function getAvgProduction(array $where = []);

    public function getTotalProduction(array $where = []);
}
