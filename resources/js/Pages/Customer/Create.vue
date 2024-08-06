<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel2.vue";
import TextInput from "@/Components/TextInput2.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const currentStep = ref(1);
const form = useForm({
    first_name: "",
    last_name: "",
    customer_email: "",
    phone_number: "",
    address_line_1: "",
    address_line_2: "",
    city: "",
    county: "",
    postcode: "",
});

const nextStep = () => {
    currentStep.value = 2;
};

const prevStep = () => {
    currentStep.value = 1;
};

const handleSubmit = () => {
    if (currentStep.value === 2) {
        form.post(route("customer.store"));
    }
};

watch(
    () => form.errors,
    (newErrors) => {
        if (
            newErrors.first_name ||
            newErrors.last_name ||
            newErrors.customer_email ||
            newErrors.phone_number
        ) {
            currentStep.value = 1;
        }
    }
);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create a customer" />

        <div class="form_container">
            <form @submit.prevent="handleSubmit">
                <h1>Add a new customer</h1>
                <!-- personal info -->
                <div v-if="currentStep === 1">
                    <InputLabel for="first_name" text="First Name" />
                    <TextInput
                        v-model="form.first_name"
                        id="first_name"
                        autofocus
                    />
                    <p v-if="form.errors.first_name" class="error">
                        {{ form.errors.first_name }}
                    </p>

                    <InputLabel for="last_name" text="Last Name" />
                    <TextInput v-model="form.last_name" id="last_name" />
                    <p v-if="form.errors.last_name" class="error">
                        {{ form.errors.last_name }}
                    </p>

                    <InputLabel for="customer_email" text="Email" />
                    <TextInput
                        v-model="form.customer_email"
                        id="customer_email"
                    />
                    <p v-if="form.errors.customer_email" class="error">
                        {{ form.errors.customer_email }}
                    </p>

                    <InputLabel for="phone_number" text="Phone Number" />
                    <TextInput v-model="form.phone_number" id="phone_number" />
                    <p v-if="form.errors.phone_number" class="error">
                        {{ form.errors.phone_number }}
                    </p>

                    <div class="btn-container">
                        <button type="button" @click="nextStep" class="btn">
                            Next
                        </button>
                    </div>
                </div>

                <!-- address info -->
                <div v-if="currentStep === 2">
                    <InputLabel for="address_line_1" text="Address Line 1" />
                    <TextInput
                        v-model="form.address_line_1"
                        id="address_line_1"
                    />
                    <p v-if="form.errors.address_line_1" class="error">
                        {{ form.errors.address_line_1 }}
                    </p>

                    <InputLabel for="address_line_2" text="Address Line 2" />
                    <TextInput
                        v-model="form.address_line_2"
                        id="address_line_2"
                    />
                    <p v-if="form.errors.address_line_2" class="error">
                        {{ form.errors.address_line_2 }}
                    </p>

                    <InputLabel for="city" text="City" />
                    <TextInput v-model="form.city" id="city" />
                    <p v-if="form.errors.city" class="error">
                        {{ form.errors.city }}
                    </p>

                    <InputLabel for="county" text="County" />
                    <TextInput v-model="form.county" id="county" />
                    <p v-if="form.errors.county" class="error">
                        {{ form.errors.county }}
                    </p>

                    <InputLabel for="postcode" text="Postcode" />
                    <TextInput v-model="form.postcode" id="postcode" />
                    <p v-if="form.errors.postcode" class="error">
                        {{ form.errors.postcode }}
                    </p>

                    <div class="btn-container">
                        <button type="button" @click="prevStep" class="btn">
                            Back
                        </button>
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
h1 {
    margin-bottom: 1rem;
    font-size: 2.5rem;
    align-self: center;
}
.btn-container {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
}
.btn {
    background-color: lightblue;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}
</style>
