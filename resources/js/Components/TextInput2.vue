<template>
    <input
      type="text"
      :id="id"
      :placeholder="placeholder"
      :value="modelValue"
      @input="handleInput"
      class="text_input"
    />
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  id: String,
  label: String,
  placeholder: String,
  errorMessage: String,
  modelValue: String
});

const emit = defineEmits(['update:modelValue']);

const handleInput = (event) => {
  emit('update:modelValue', event.target.value);
};

</script>
<style scoped>
    .text_input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        outline: none;
    }
    .text_input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

</style>
