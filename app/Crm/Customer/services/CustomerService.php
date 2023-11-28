<?php

namespace Crm\Customer\services;

use Illuminate\Http\Request;
use Crm\Customer\Models\Customer;
use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Requests\CustomerRequest;
use Symfony\Component\HttpFoundation\Response;
use Crm\Customer\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request)
    {
        return $this->customerRepository->all();
    }

    public function show(string $id)
    {
        return $this->customerRepository->find($id);
    }

    public function create(string $name)
    {
        $customer = new Customer();
        $customer->name = $name;
        $customer->save();

        event(new CustomerCreation($customer));
        return $customer;
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        $customer->name = $request->get('name');
        $customer->save();

        return $customer;
    }


    public function delete(Request $request, int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response()->json(['status' => 'deleted'], Response::HTTP_OK);
        }
        return response()->json(['status' => 'customer not found'], Response::HTTP_NOT_FOUND);
    }
}
