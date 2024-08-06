<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        // Fetch all customers
        $customers = Customer::all();
        // Render the index page with customers data
        return Inertia::render('Customer/Index', ['customers' => $customers, 'success' => session('success')]);
    }

    public function create(){
        // render the create page
        return Inertia::render('Customer/Create');
    }
    public function store(Request $request){
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'customer_email' => 'required|string|lowercase|email|max:255|unique:customers,customer_email',
            'phone_number' => 'required|string|size:11|unique:customers,phone_number',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'nullable|string|max:255',
            'postcode' => 'required|string|size:7',
        ]);
        // Create the customer record with the validated data
        Customer::create($validatedData);
        // redirect to the index page with a success message
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }
    public function edit(Customer $customer){
        // render the edit page
        return Inertia::render('Customer/Edit', ['customer' => $customer]);
    }

    public function update(Request $request, Customer $customer){
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'customer_email' => 'required|string|lowercase|email|max:255|unique:customers,customer_email,' . $customer->id,
            'phone_number' => 'required|string|size:11|unique:customers,phone_number,' . $customer->id,
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'nullable|string|max:255',
            'postcode' => 'required|string|size:7',
        ]);
        // Update the customer record with the validated data
        $customer->update($validatedData);
        // redirect to the index page with a success message
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer){
        // Delete the customer record
        $customer->delete();
        // redirect to the index page with a success message
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
