<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return Customer::all();
    }

    public function show(string $id)
    {
        return Customer::find($id) ??
            response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->save();
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


    public function delete(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response()->json(['status' => 'deleted'], Response::HTTP_OK);
        } else {
            return response()->json(['status' => 'customer not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
