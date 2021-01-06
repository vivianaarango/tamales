<?php
namespace App\Repositories\Contracts;

use App\Models\Production;

/**
 * Interface DbProductionRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface DbProductionRepositoryInterface
{
    /**
     * @param int $productionID
     * @return Production
     */
    public function findByID(int $productionID): Production;
}
