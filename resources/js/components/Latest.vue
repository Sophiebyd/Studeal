<template>
    <section class="latest-ads my-5">
        <h2 class="text-center">Les dernières annonces</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-flex flex-column align-items-center"
                    v-for="ad in latestArticles" :key="ad.id">
                    <div class="card mb-4" style="width: 100%;">
                        <img :src="ad.image" class="card-img-top" :alt="ad.title">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ ad.title }}</h5>
                            <p class="card-text">{{ ad.price }} €</p>
                        </div>
                    </div>
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
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-body {
    text-align: center;
}

.card-img-top {
    height: 160px;
    object-fit: cover;
}

.row {
    justify-content: space-around;
}

.col-12 {
    margin-bottom: 1.5rem;
}

/* Responsives */
@media (min-width: 1200px) {
    .row {
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .col-xl-2 {
        flex: 0 0 19%;
        max-width: 19%;
    }

    .card-img-top {
        height: 220px;
    }

    .card-body {
        padding: 1.2rem;
    }

    .card-title {
        font-size: 1.4rem;
    }

    .card-text {
        font-size: 1.2rem;
    }
}

@media (max-width: 768px) {
    .col-md-4 {
        max-width: 48%;
    }

    .card-img-top {
        height: 160px;
    }

    .card-title {
        font-size: 1.2rem;
    }

    .card-text {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .col-sm-6 {
        max-width: 100%;
    }

    .card-img-top {
        height: 150px;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card-text {
        font-size: 0.95rem;
    }
}
</style>
