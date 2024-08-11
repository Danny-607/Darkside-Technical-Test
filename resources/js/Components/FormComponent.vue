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

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 1.5rem;
    margin: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    max-width: 85%;
    min-width: 45%;
}

h1 {
    margin-bottom: 1rem;
    font-size: 1.5rem;
    text-align: center;
}

.form_container {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Change size of the form on smaller screen sizes to make it easier for users. */
@media(max-width: 400px){

    .form_container{
        margin: 1.5rem 0;
    }
    form{
        width: 100vw;
    }

}

@media (min-width: 768px) {
    form {
        width: 75vw;
    }

    h1 {
        font-size: 2rem;
    }

}

@media (min-width: 1024px) {
    form {
        width: 45vw;
    }

}
</style>
