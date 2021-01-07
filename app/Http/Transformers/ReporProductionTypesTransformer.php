<?php
namespace App\Http\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use stdClass;

/**
 * Class ReporProductionTypesTransformer
 * @package App\Http\Transformers
 */
class ReporProductionTypesTransformer extends TransformerAbstract
{
    /**
     * @param array $item
     * @return array
     */
    public function transform(stdClass $item): array
    {
        return [
            'id' => $item->type_id,
            'name' => $item->name,
            'quantity' => $item->quantity
        ];
    }
}
