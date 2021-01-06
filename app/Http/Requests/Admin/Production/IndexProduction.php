<?php
namespace App\Http\Requests\Admin\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexProduction
 * @package App\Http\Requests\Admin\Production
 */
class IndexProduction extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderBy' => 'in:id,lot,marmitas,broken,total,date|nullable',
            'orderDirection' => 'in:asc,desc|nullable',
            'search' => 'string|nullable',
            'page' => 'integer|nullable',
            'per_page' => 'integer|nullable',
        ];
    }
}
