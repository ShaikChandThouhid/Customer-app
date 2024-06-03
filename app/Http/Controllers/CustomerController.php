<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $filter_date = $request->query('filter_date');
        if ($filter_date) {
            $customers = Customer::whereDate('date_of_birth', $filter_date)->get();
        } else {
            $customers = Customer::all();
        }
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

   // CustomerController.php

   public function store(Request $request)
   {
       \Log::info('Form Data:', $request->all());
   
       $request->validate([
           'first_name' => 'required|string|max:50',
           'last_name' => 'required|string|max:50',
           'email' => 'required|string|email|max:50|unique:customers',
           'phone_number' => 'required|string|size:10|unique:customers',
           'date_of_birth' => 'required|date',
       ]);
   
       Customer::create($request->only(['first_name', 'last_name', 'email', 'phone_number', 'date_of_birth']));
   
       return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
   }
   


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:customers,email,' . $id,
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->only(['first_name', 'last_name', 'email']));

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }
}
