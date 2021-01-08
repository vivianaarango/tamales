<?php
namespace App\Exports;

use App\Models\Production;
use App\Models\ProductionType;
use App\Models\Type;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Class ProductionExport
 * @package App\Exports
 */
class ProductionExport implements FromArray, WithMapping, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        $data = [];
        $production = Production::orderBy('date', 'asc')->get();

        foreach ($production as $item) {
            $prod['id'] = $item->id;
            $prod['date'] = $item->date;
            $prod['lot'] = $item->lot;
            $prod['marmitas'] = $item->marmitas;
            $prod['broken'] = $item->broken;
            $prod['total'] = $item->total;

            $type = Type::all();
            foreach ($type as $key => $value) {
                $prodType = ProductionType::where('production_id', $item->id)
                    ->join('types', 'types.id', '=', 'production_types.type_id')
                    ->where('type_id', $value->id)
                    ->first();

                 if (!is_null($prodType)){
                     $prod[$prodType->name] = $prodType->quantity;
                 } else {
                     $prod[$item->name] = 0;
                 }
            }

            array_push($data, $prod);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $headers = [];
        array_push($headers, 'ID');
        array_push($headers, 'Fecha');
        array_push($headers, 'Lote');
        array_push($headers, 'Número de marmitas');
        array_push($headers, 'Rotos');
        array_push($headers, 'Total');

        $type = Type::all();
        foreach ($type as $key => $value) {
            array_push($headers, $value->name);
        }

        return $headers;
    }

    /**
     * @param mixed $export
     * @return string[]
     */
    public function map($export): array
    {
        return [
            $export,
        ];
    }
}
