<?php

namespace Crm\Project\Requests;

use Crm\Base\Requests\ApiRequest;

class ProjectRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_name' => 'required|min:3',
            'status' => 'required:numeric',
            'project_cost'=>'required:numeric',
        ];
    }
}
