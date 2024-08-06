<template>
    <nav :class="{'active' : menuActive}">
      <ul :class="{'active': menuActive}">
        <slot></slot>
      </ul>
      <button @click="toggleMenu" class="hamburger_btn" :class="{'active' : menuActive}">☰</button>
    </nav>
  </template>

  <script setup>
  import { ref } from 'vue';

  const menuActive = ref(false);

  const toggleMenu = () => {
    menuActive.value = !menuActive.value;
  };
  </script>

  <style scoped>
  nav {
    display: flex;
    justify-content: right;
    background-color: #f5f5f5;
    color: #333;
    padding: 10px;
    width: 100%;
  }
  ul {
    display: none;
  }
  nav.active {
    position: fixed;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    color: #333;
    padding: 10px;
    height: 100vh;
    width: 100%;
  }
  ul.active {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    color: #333;
    padding: 10px;
    height: 100vh;
    width: 100%;
  }
  .hamburger_btn {
    background-color: #f5f5f5;
    color: #333;
    border: none;
    font-size: 2rem;
  }
  .hamburger_btn.active {
    align-self: flex-end;
    order: -1;
  }
  @media (min-width: 768px) {
    .hamburger_btn {
      display: none;
    }
    ul {
      height: 10vh;
      width: 100%;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      place-items: center;
      background-color: #f5f5f5;
      color: #333;
      padding: 10px;
    }
  }
  </style>
