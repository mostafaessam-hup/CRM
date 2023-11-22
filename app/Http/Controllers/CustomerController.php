<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crm\Customer\Requests\CustomerRequest;
use Crm\Customer\services\CustomerService;

class CustomerController extends Controller
{
    private CustomerService $customerServices;

    public function __construct(CustomerService $customerServices)
    {
        $this->customerServices = $customerServices;
    }

    public function index(Request $request)
    {
        return $this->customerServices->index($request);
    }

    public function show(string $id)
    {
        return $this->customerServices->show($id);
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
}
