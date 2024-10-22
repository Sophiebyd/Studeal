<template>
    <div class="app-container">
        <Navbar />
        <RouterView />
        <Footer />
    </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
</script>

<style scoped>
body {
    font-family: 'Meiryo', sans-serif;
}

.app-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

Footer {
    margin-top: auto;
}
</style>
