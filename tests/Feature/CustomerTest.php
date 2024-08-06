<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    // All routes for customers are protected by authentication middleware. Make sure to authenticate user before making requests.

    public function test_create_page_loads()
    {
        // Create a user instance
        $user = User::factory()->create();
        // Authenticate and make the request
        $response = $this->actingAs($user)->get('/customer/create');
        $response->assertStatus(200);
    }


    public function test_create_customer()
    {
        // Create a user instance
        $user = User::factory()->create();
        $customerData = $this->getCustomerData();
        // Authenticate and make the request
        $response = $this->actingAs($user)->post('/customer', $customerData);
        // Check for redirect after successful creation
        $response->assertStatus(302);

        $this->assertDatabaseHas('customers', $customerData);
    }


    public function test_can_update_a_customer()
    {
        // Create a user instance
        $user = User::factory()->create();
        $customer = Customer::create($this->getInitialCustomerData());

        $updatedData = $this->getUpdatedCustomerData();
        // Authenticate and make the request
        $response = $this->actingAs($user)->patch("/customer/{$customer->id}", $updatedData);
         // Check for redirect after successful update
        $response->assertStatus(302);
        $this->assertDatabaseHas('customers', $updatedData);
        $this->assertDatabaseMissing('customers', $this->getInitialCustomerData());
    }

    public function test_can_delete_a_customer()
    {
        // Create a user instance
        $user = User::factory()->create();
        $customer = Customer::create($this->getInitialCustomerData());
        // Authenticate and make the request
        $response = $this->actingAs($user)->delete("/customer/{$customer->id}");
        // Check for redirect after successful deletion
        $response->assertStatus(302);

        $this->assertDatabaseMissing('customers', $this->getInitialCustomerData());
    }

    public function test_can_view_a_customer_edit_page()
    {
        // Create a user instance
        $user = User::factory()->create();
        $customer = Customer::create($this->getInitialCustomerData());
        // Authenticate and make the request
        $response = $this->actingAs($user)->get("/customer/{$customer->id}/edit");
        $response->assertStatus(200);
    }


    public function test_can_update_a_customer_using_the_edit_form()
    {
        // Create a user instance
        $user = User::factory()->create();
        $customer = Customer::create($this->getInitialCustomerData());
        // Authenticate and make the request
        $response = $this->actingAs($user)->get("/customer/{$customer->id}/edit");
        $response->assertStatus(200);

        $updatedData = $this->getUpdatedCustomerData();
        // Authenticate and make the request
        $response = $this->actingAs($user)->patch("/customer/{$customer->id}", $updatedData);
        // Check for redirect after successful update
        $response->assertStatus(302);
        $this->assertDatabaseHas('customers', $updatedData);
        $this->assertDatabaseMissing('customers', $this->getInitialCustomerData());
    }


    public function test_displays_customers_on_the_index_page()
    {
         // Create a user instance
        $user = User::factory()->create();
        $customer = Customer::create($this->getCustomerData());
        // Authenticate and make the request
        $response = $this->actingAs($user)->get('/customer/dashboard');
        $response->assertStatus(200);

        $this->assertSeeCustomerData($response, $customer);
    }

    // Helper functions
    protected function getInitialCustomerData()
    {
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'customer_email' => 'john.doe@test.com',
            'phone_number' => '12345678901',
            'address_line_1' => '123 Old Address',
            'address_line_2' => 'Apt 4B',
            'city' => 'Old City',
            'county' => 'Old County',
            'postcode' => '1234567',
        ];
    }


    protected function getUpdatedCustomerData()
    {
        return [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'customer_email' => 'jane.smith@test.com',
            'phone_number' => '09876543210',
            'address_line_1' => '456 New Address',
            'address_line_2' => 'Suite 1A',
            'city' => 'New City',
            'county' => 'New County',
            'postcode' => '6543211',
        ];
    }

    protected function getCustomerData()
    {
        return [
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'customer_email' => 'alice.smith@example.com',
            'phone_number' => '98765432101',
            'address_line_1' => '789 Maple St',
            'address_line_2' => 'Unit 5',
            'city' => 'Springfield',
            'county' => 'Greene',
            'postcode' => '6789013',
        ];
    }


    protected function assertSeeCustomerData($response, $customer)
    {
        $response->assertSee($customer->first_name);
        $response->assertSee($customer->last_name);
        $response->assertSee($customer->customer_email);
        $response->assertSee($customer->phone_number);
        $response->assertSee($customer->address_line_1);
        $response->assertSee($customer->address_line_2);
        $response->assertSee($customer->city);
        $response->assertSee($customer->county);
        $response->assertSee($customer->postcode);
    }
}
