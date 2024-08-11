<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Receives customers and success message from the controller
const props = defineProps({
    customers: Array,
    success: String,
});
// Success message from the controller
const successMessage = props.success;
const form = useForm({});

// Delete the selected customer
const handleDelete = (customerId) => {
    if (window.confirm("Are you sure you want to delete this customer?")) {
        form.delete(route("customer.destroy", { customer: customerId }));
    }
};
// Sends user to edit page for the selected customer
const handleUpdate = (customerId) => {
    window.location.href = `/customer/${customerId}/edit`;
};
// Sends user to create page
const handleCreate = () => {
    window.location.href = "/customer/create";
};
</script>

<template>
    <AuthenticatedLayout>
        <!-- sets title of the page -->
        <Head title="Customer Dashboard" />
        <div>
            <!-- table to display customer records -->
            <h1>Customers List</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address Line 1</th>
                            <th>Address Line 2</th>
                            <th>City</th>
                            <th>County</th>
                            <th>Postcode</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <td data-cell="First Name">{{ customer.first_name }}</td>
                            <td data-cell="Last Name">{{ customer.last_name }}</td>
                            <td data-cell="Email">{{ customer.customer_email }}</td>
                            <td data-cell="Phone Number">{{ customer.phone_number }}</td>
                            <td data-cell="Address Line 1">{{ customer.address_line_1 }}</td>
                            <td data-cell="Address Line 2">{{ customer.address_line_2 }}</td>
                            <td data-cell="City">{{ customer.city }}</td>
                            <td data-cell="County">{{ customer.county }}</td>
                            <td data-cell="Postcode">{{ customer.postcode }}</td>
                            <td>
                                <!-- Buttons for deleting and sending user to edit page -->
                                <button class="update-btn btn"@click="handleUpdate(customer.id)">Update</button>
                                <button class="delete-btn btn" @click="handleDelete(customer.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Displays success message with data from the controller -->
                <p class="success" v-if="successMessage">
                    {{ successMessage }}
                </p>
            </div>
            <!-- Create button -->
            <div class="create-btn-container">
                <button class="create-btn btn" @click="handleCreate">
                    Create New Customer
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Useful for mobile and tablet screens to have an overflow creating a scrollable table */
.table-container {
    overflow-x: auto;
    margin-top: 1rem;
}
/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 0.5rem;
    text-align: left;
    border: 1px solid #ccc;
}

thead {
    background-color: #f9f9f9;
}

tr:nth-child(2n) {
    background-color: #f2f2f2;
}

h1 {
    margin-bottom: 1rem;
    font-size: 3rem;
    text-align: center;
}

.btn {
    width: fit-content;
    min-width: 100px;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 0.5rem;
}
/* Button styles  */
.update-btn {
    background-color: lightblue;
}

.delete-btn {
    background-color: red;
}

.create-btn-container {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
}

.create-btn {
    background-color: green;
}

button:hover {
    opacity: 0.8;
    text-decoration: underline;
}
/* style success paragraph */
.success {
    color: green;
    font-size: 1.5rem;
    text-align: right;
    margin-top: 1rem;
}
/* Change table into a grid to remove the need for the awkward scrolling overflow */
@media (max-width: 768px) {
    th{
        display: none;
    }
    td{
        display: grid;
        grid-template-columns: 17.5% auto;
        padding: 0.5rem;
    }

    td::before{
        content: attr(data-cell) ":";
        font-weight: bold;

        margin-bottom: 0.5rem;
    }
    /* Remove ":" for the buttons column */
    td:last-child::before{
        content: none;
    }
    td:last-child{
        display: flex;
        justify-content: center;
    }
}
@media (max-width: 400px) {
    td{
        grid-template-columns: 35% auto;
    }
    h1{
        font-size: 2rem;
    }


}

</style>
