<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    customers: Array,
    success: String
});

const successMessage = props.success;
const form = useForm({});

const handleDelete = (customerId) => {
    form.delete(route("customer.destroy", { customer: customerId }));
};

const handleUpdate = (customerId) => {
    window.location.href = `/customer/${customerId}/edit`;
};

const handleCreate = () => {
    window.location.href = "/customer/create";
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Customer Dashboard" />
        <div>
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
                            <td>{{ customer.first_name }}</td>
                            <td>{{ customer.last_name }}</td>
                            <td>{{ customer.customer_email }}</td>
                            <td>{{ customer.phone_number }}</td>
                            <td>{{ customer.address_line_1 }}</td>
                            <td>{{ customer.address_line_2 }}</td>
                            <td>{{ customer.city }}</td>
                            <td>{{ customer.county }}</td>
                            <td>{{ customer.postcode }}</td>
                            <td>
                                <button
                                    class="update-btn btn"
                                    @click="handleUpdate(customer.id)"
                                >
                                    Update
                                </button>
                                <button
                                    class="delete-btn btn"
                                    @click="handleDelete(customer.id)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="success" v-if="successMessage">{{ successMessage }}</p>
            </div>
            <div class="create-btn-container">
                <button class="create-btn btn" @click="handleCreate">
                    Create New Customer
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.table-container {
    overflow-x: auto;
    margin-top: 1rem;
}

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
.success {
    color: green;
    font-size: 1.5rem;
    text-align: right;
    margin-top: 1rem;
}

button:hover {
    opacity: 0.8;
}
</style>
