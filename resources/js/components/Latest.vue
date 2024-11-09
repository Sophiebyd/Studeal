<template>
    <section class="latest-ads my-5">
        <h2 class="text-center">Les dernières annonces</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-flex flex-column align-items-center"
                    v-for="ad in latestArticles" :key="ad.id">
                    <router-link :to="`/article/${ad.id}`" class="mb-4" style="width: 85%;">
                        <div class="card">
                            <img :src="ad.image" class="card-img-top" :alt="ad.title">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ ad.title }}</h5>
                                <p class="card-text">{{ ad.price }} €</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import * as ArticleService from '../_services/ArticleService';

const latestArticles = ref([]);

onMounted(async () => {
    latestArticles.value = await ArticleService.getLatestArticles();
    console.log(latestArticles.value);
});
</script>

<style scoped>
h2 {
    font-family: 'Verdana', sans-serif;
    margin-bottom: 30px;
}

.card-title {
    font-family: 'Meiryo', sans-serif;
}

.card {
    border: 1px solid #ddd;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.card-body {
    text-align: center;
    padding: 0.7rem;
}

.card-img-top {
    height: 110px;
    object-fit: cover;
}

.row {
    justify-content: space-around;
}

.col-12 {
    margin-bottom: 1rem;
}

/* Responsives */
@media (min-width: 1200px) {
    .row {
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .col-xl-2 {
        flex: 0 0 17%;
        max-width: 17%;
    }

    .card-img-top {
        height: 170px;
    }

    .card-body {
        padding: 0.9rem;
    }

    .card-title {
        font-size: 1.15rem;
    }

    .card-text {
        font-size: 1rem;
    }
}

@media (max-width: 768px) {
    .col-md-4 {
        max-width: 48%;
    }

    .card-img-top {
        height: 100px;
    }

    .card-title {
        font-size: 1.05rem;
    }

    .card-text {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .col-sm-6 {
        max-width: 100%;
    }

    .card-img-top {
        height: 90px;
    }

    .card-title {
        font-size: 0.95rem;
    }

    .card-text {
        font-size: 0.85rem;
    }
}
</style>
