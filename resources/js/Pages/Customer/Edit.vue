<script setup>
import { ref, watch, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel2 from "@/Components/InputLabel2.vue";
import TextInput2 from "@/Components/TextInput2.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormComponent from "@/Components/FormComponent.vue";

import { Head } from "@inertiajs/vue3";
const props = defineProps({
    customer: Object,
    errors: Object,
});

const currentStep = ref(1);
const form = useForm({
    first_name: props.customer.first_name,
    last_name: props.customer.last_name,
    customer_email: props.customer.customer_email,
    phone_number: props.customer.phone_number,
    address_line_1: props.customer.address_line_1,
    address_line_2: props.customer.address_line_2,
    city: props.customer.city,
    county: props.customer.county,
    postcode: props.customer.postcode,
});

const nextStep = () => {
    currentStep.value = 2;
};

const prevStep = () => {
    currentStep.value = 1;
};

const handleSubmit = () => {
    form.patch(route("customer.update", props.customer.id));
};

watch(
    () => props.errors,
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
        <Head title="Edit customer" />
        <FormComponent
            heading="Edit existing customer"
            @submit.prevent="handleSubmit"
        >
            <!-- Step 1: Personal Information -->
            <div v-if="currentStep === 1">
                <InputLabel2 for="first_name" text="First Name" />
                <TextInput2 type="text" v-model="form.first_name" id="first_name" autofocus/>
                <p v-if="props.errors.first_name" class="error">
                    {{ props.errors.first_name }}
                </p>

                <InputLabel2 for="last_name" text="Last Name" />
                <TextInput2 type="text" v-model="form.last_name" id="last_name" />
                <p v-if="props.errors.last_name" class="error">
                    {{ props.errors.last_name }}
                </p>

                <InputLabel2 for="customer_email" text="Email" />
                <TextInput2 type="email" v-model="form.customer_email" id="customer_email" />
                <p v-if="props.errors.customer_email" class="error">
                    {{ props.errors.customer_email }}
                </p>

                <InputLabel2 for="phone_number" text="Phone Number" />
                <TextInput2 type="tel" v-model="form.phone_number" id="phone_number" />
                <p v-if="props.errors.phone_number" class="error">
                    {{ props.errors.phone_number }}
                </p>

                <div class="btn-container">
                    <button type="button" @click="nextStep" class="btn">
                        Next
                    </button>
                </div>
            </div>

            <!-- Step 2: Address Information -->
            <div v-if="currentStep === 2">
                <InputLabel2 for="address_line_1" text="Address Line 1" />
                <TextInput2 type="text" v-model="form.address_line_1" id="address_line_1" />
                <p v-if="props.errors.address_line_1" class="error">
                    {{ props.errors.address_line_1 }}
                </p>

                <InputLabel2 for="address_line_2" text="Address Line 2" />
                <TextInput2 type="text" v-model="form.address_line_2" id="address_line_2" />
                <p v-if="props.errors.address_line_2" class="error">
                    {{ props.errors.address_line_2 }}
                </p>

                <InputLabel2 for="city" text="City" />
                <TextInput2 type="text" v-model="form.city" id="city" />
                <p v-if="props.errors.city" class="error">
                    {{ props.errors.city }}
                </p>

                <InputLabel2 for="county" text="County" />
                <TextInput2 type="text" v-model="form.county" id="county" />
                <p v-if="props.errors.county" class="error">
                    {{ props.errors.county }}
                </p>

                <InputLabel2 for="postcode" text="Postcode" />
                <TextInput2 type="text" v-model="form.postcode" id="postcode" />
                <p v-if="props.errors.postcode" class="error">
                    {{ props.errors.postcode }}
                </p>

                <div class="btn-container">
                    <button type="button" @click="prevStep" class="btn">
                        Back
                    </button>
                    <button type="submit" class="btn">Update Customer</button>
                </div>
            </div>
        </FormComponent>
    </AuthenticatedLayout>
</template>

<style scoped>
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
