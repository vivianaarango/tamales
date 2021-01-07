<?php
namespace App\Http\Requests\Admin\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexType
 * @package App\Http\Requests\Admin\Production
 */
class IndexType extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'orderBy' => 'in:id,name|nullable',
            'orderDirection' => 'in:asc,desc|nullable',
            'search' => 'string|nullable',
            'page' => 'integer|nullable',
            'per_page' => 'integer|nullable',
        ];
    }
}
