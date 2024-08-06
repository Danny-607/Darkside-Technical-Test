<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import NavbarComponent from '@/Components/NavbarComponent.vue';
import NavLink2 from '@/Components/NavLink2.vue';

const props = defineProps({
    user: Object,
});
const links = [
    { text: 'Customer Dashboard', url: '/customer/dashboard' },
];
const form = useForm({});
const logout = () => {
    form.post(route('logout'));
};
</script>

<template>
    <div>
        <NavbarComponent>
            <NavLink2 :links="links" />
            <div class="">
                <button @click="logout" class="btn logout-btn">Logout</button>
            </div>
        </NavbarComponent>
    </div>
    <main>
        <slot></slot>
    </main>
</template>

<style scoped>
.btn {
    padding: 10px 20px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.logout-btn {
    background-color: #ff4d4d;
    color: white;
}

.logout-btn:hover {
    background-color: #ff1a1a;
}

.logout-btn:active {
    background-color: #e60000;
}
</style>
