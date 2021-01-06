<?php
namespace App\Repositories;

use App\Models\Production;
use App\Repositories\Contracts\DbProductionRepositoryInterface;

/**
 * Class DbProductionRepository
 * @package App\Repositories
 */
class DbProductionRepository implements DbProductionRepositoryInterface
{
    /**
     * @param int $productionID
     * @return Production
     */
    public function findByID(int $productionID): Production
    {
        return Production::findOrFail($productionID);
    }
}
