<?php

namespace App\Http\Controllers;

use Crm\Project\Services\ProjectService;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct (ProjectService $projectService)
    {
        $this->projectService=$projectService;
    }
}
