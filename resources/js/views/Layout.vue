<template>
    <div>
        <Navbar />
        <router-view />
        <Footer />
    </div>
</template>

<script setup>
import Navbar from '../js/components/Navbar.vue';
import Banner from '../js/components/Banner.vue';
import Categories from '../js/components/Categories.vue';
import Latest from '../js/components/Latest.vue';
import Footer from '../js/components/Footer.vue';


</script>

<style scoped>
body {
    font-family: 'Meiryo', sans-serif;
}
</style>