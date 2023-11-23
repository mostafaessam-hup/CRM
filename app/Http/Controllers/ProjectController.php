<?php

namespace App\Http\Controllers;

use Crm\Project\Requests\ProjectRequest;
use Crm\Project\Services\ProjectService;
use Crm\Customer\services\CustomerService;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    private CustomerService $customerServices;

    public function __construct(ProjectService $projectService,CustomerService $customerServices )
    {
        $this->projectService = $projectService;
        $this->customerServices = $customerServices;
    }

    public function createProject(ProjectRequest $request, $customerId)
    {
        $customer = $this->customerServices->show($customerId);
        if (!$customer) {
            return response()->json(['status' => 'customer not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->projectService->createProject($request, $customerId);
    }
}
