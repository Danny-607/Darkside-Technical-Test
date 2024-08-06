<script setup>
defineProps({
    heading: String,
});
</script>

<template>
    <div class="form_container">
        <form>
            <h1>{{ heading }}</h1>
            <slot></slot>
        </form>
    </div>
</template>

<style scoped>
h1 {
    margin-bottom: 1rem;
    font-size: 2.5rem;
    align-self: center;
}
form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 2rem;
    margin: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    /* Larger form for tables and mobile layouts */
    width: 90vw;
  }
  .form_container{
    display: flex;
    justify-content: center;
    align-items: center;

    height: 85vh;
    margin: 0
}
@media (min-width: 768px) {
    /* Smaller form for desktop users */
    form {
        width: 40vw;

    }

}
</style>
