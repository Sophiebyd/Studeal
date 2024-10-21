<template>
    <div>
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
</style>