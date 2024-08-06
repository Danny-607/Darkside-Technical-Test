<template>
    <Link
      v-for="(link, index) in links"
      :key="index"
      :href="link.url"
      class="nav_link"
    >
      {{ link.text }}
    </Link>
  </template>

  <script setup>
  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';

  const props = defineProps({
    links: {
      type: Array,
      required: true
    }
  });
  </script>

  <style scoped>
  .nav_link {
    color: #333;
    text-decoration: none;
    padding: 15px;
    margin: 0 5px;
    border-radius: 5px;
    background-color: #f5f5f5;
    font-size: 1.6rem;
  }

  .nav_link:hover {
    background-color: #e0e0e0;
  }

  .nav_link:active {
    background-color: #ccc;
  }
  </style>
