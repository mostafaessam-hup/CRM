<?php

namespace Crm\Customer\services;

use Crm\Customer\Events\CustomerCreation;
use Illuminate\Http\Request;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\CustomerRequest;
use Symfony\Component\HttpFoundation\Response;

class CustomerService
{

    public function index(Request $request)
    {
        return Customer::all();
    }

    public function show(string $id)
    {
        return Customer::find($id) ;
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
