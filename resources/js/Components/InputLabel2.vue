<script setup>
import { defineProps } from 'vue';

defineProps({
    inputFor: String,
    text: String,
});
</script>

<template>
    <label :for="inputFor" class="input_label">
        {{ text }}
    </label>
</template>

<style scoped>
label{
    font-size: 1.4rem;
}
</style>
