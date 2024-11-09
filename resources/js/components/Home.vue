<template>
    <Banner/>
    <SecondBanner/>
    <Categories/>
    <Latest/>
</template>

<script setup>
import Banner from './Banner.vue';
import Categories from './Categories.vue';
import Latest from './Latest.vue';
import SecondBanner from './SecondBanner.vue';
import * as ArticleService from '../_services/ArticleService';

ArticleService.getArticles();

onMounted(async () => {
    const res = await ArticleService.getArticles();
});
</script>