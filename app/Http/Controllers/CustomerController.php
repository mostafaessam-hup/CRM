<?php

namespace App\Http\Controllers;

use Crm\Customer\services\Export\ExportFactory;
use Illuminate\Http\Request;
use Crm\Customer\Requests\CustomerRequest;
use Crm\Customer\services\CustomerExportService;
use Crm\Customer\services\CustomerService;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    private CustomerService $customerServices;

    protected CustomerExportService $customerExportService;

    public function __construct(CustomerService $customerServices, CustomerExportService $customerExportService)
    {
        $this->customerServices = $customerServices;
        $this->customerExportService = $customerExportService;
    }

    public function index(Request $request)
    {
        return $this->customerServices->index($request);
    }

    public function show(string $id)
    {
        return $this->customerServices->show($id) ??
            response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(CustomerRequest $request)
    {
        return $this->customerServices->create($request->name);
    }

    public function update(Request $request, $id)
    {
        return  $this->customerServices->update($request, $id);
    }


    public function delete(Request $request, $id)
    {
        return $this->customerServices->delete($request, (int)$id);
    }

    public function export(Request $request)
    {
        $format = $request->get("format", "json");
        $exporter = ExportFactory::instance($format);
        $this->customerExportService->export($exporter);
    }
}
