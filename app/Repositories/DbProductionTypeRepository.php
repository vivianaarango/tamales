<?php
namespace App\Repositories;

use App\Models\ProductionType;
use App\Models\User;
use App\Repositories\Contracts\DbProductionTypeRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class DbProductionRepository
 * @package App\Repositories
 */
class DbProductionTypeRepository implements DbProductionTypeRepositoryInterface
{
    /**
     * @param int $productionTypeID
     * @return ProductionType
     */
    public function findByID(int $productionTypeID): ProductionType
    {
        return ProductionType::findOrFail($productionTypeID);
    }

    /**
     * @param int $productionID
     * @return Collection
     */
    public function findByProductionID(int $productionID): Collection
    {
        return ProductionType::where('production_id', $productionID)
            ->join('types', 'types.id', '=', 'production_types.type_id')
            ->get();
    }

    /**
     * @param int $productionID
     * @param int $typeID
     * @return Collection
     */
    public function findByProductionIDAndTypeID(int $productionID, int $typeID): Collection
    {
        return ProductionType::where('production_id', $productionID)
            ->where('type_id', $typeID)
            ->get();
    }
}
