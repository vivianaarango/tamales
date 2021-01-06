<?php
namespace App\Repositories\Contracts;

use App\Models\ProductionType;
use Illuminate\Support\Collection;

/**
 * Interface DbProductionTypeRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface DbProductionTypeRepositoryInterface
{
    /**
     * @param int $productionTypeID
     * @return ProductionType
     */
    public function findByID(int $productionTypeID): ProductionType;

    /**
     * @param int $productionID
     * @return Collection
     */
    public function findByProductionID(int $productionID): Collection;

    /**
     * @param int $productionID
     * @param int $typeID
     * @return Collection
     */
    public function findByProductionIDAndTypeID(int $productionID, int $typeID): Collection;
}
