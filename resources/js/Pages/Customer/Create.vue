<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel2 from "@/Components/InputLabel2.vue";
import TextInput2 from "@/Components/TextInput2.vue";
import FormComponent from "@/Components/FormComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Starts the form at step 1
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
// changes the step to two when the button is clicked
const nextStep = () => {
    currentStep.value = 2;
};
// changes the step to one when the button is clicked
const prevStep = () => {
    currentStep.value = 1;
};
// handles the form submission
const handleSubmit = () => {
    if (currentStep.value === 2) {
        form.post(route("customer.store"));
    }
};
// watches if there is an error on the first step and changes the step to one
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

            <FormComponent heading="Add a new customer" @submit.prevent="handleSubmit">

                <!-- Step 1: Personal Info -->
                <div v-if="currentStep === 1">
                    <InputLabel2 for="first_name" text="First Name" />
                    <TextInput2 type="text" v-model="form.first_name" id="first_name" autofocus/>
                    <p v-if="form.errors.first_name" class="error">
                        {{ form.errors.first_name }}
                    </p>

                    <InputLabel2 for="last_name" text="Last Name" />
                    <TextInput2 type="text" v-model="form.last_name" id="last_name" />
                    <p v-if="form.errors.last_name" class="error">
                        {{ form.errors.last_name }}
                    </p>

                    <InputLabel2 for="customer_email" text="Email" />
                    <TextInput2 type="email" v-model="form.customer_email" id="customer_email"/>
                    <p v-if="form.errors.customer_email" class="error">
                        {{ form.errors.customer_email }}
                    </p>

                    <InputLabel2 for="phone_number" text="Phone Number" />
                    <TextInput2 type="tel" v-model="form.phone_number" id="phone_number" />
                    <p v-if="form.errors.phone_number" class="error">
                        {{ form.errors.phone_number }}
                    </p>

                    <div class="btn-container">
                        <button type="button" @click="nextStep" class="btn">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 2: Address Info -->
                <div v-if="currentStep === 2">
                    <InputLabel2 for="address_line_1" text="Address Line 1" />
                    <TextInput2 type="text"
                        v-model="form.address_line_1"
                        id="address_line_1"
                    />
                    <p v-if="form.errors.address_line_1" class="error">
                        {{ form.errors.address_line_1 }}
                    </p>

                    <InputLabel2 for="address_line_2" text="Address Line 2" />
                    <TextInput2 type="text" v-model="form.address_line_2" id="address_line_2"/>
                    <p v-if="form.errors.address_line_2" class="error">
                        {{ form.errors.address_line_2 }}
                    </p>

                    <InputLabel2 for="city" text="City" />
                    <TextInput2 type="text" v-model="form.city" id="city" />
                    <p v-if="form.errors.city" class="error">
                        {{ form.errors.city }}
                    </p>

                    <InputLabel2 for="county" text="County" />
                    <TextInput2 type="text" v-model="form.county" id="county" />
                    <p v-if="form.errors.county" class="error">
                        {{ form.errors.county }}
                    </p>

                    <InputLabel2 for="postcode" text="Postcode" />
                    <TextInput2 type="text" v-model="form.postcode" id="postcode" />
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
