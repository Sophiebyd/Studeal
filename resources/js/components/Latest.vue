<template>
    <section class="latest-ads my-5">
        <h2 class="text-center">Les dernières annonces</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2 d-flex flex-column align-items-center" v-for="ad in ads" :key="ad.id">
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

<script>
export default {
    data() {
        return {
            ads: [
                { id: 1, title: 'Appartement à louer', price: 500, image: '/images/ad1.png' },
                { id: 2, title: 'Voiture à vendre', price: 2500, image: '/images/ad2.png' },
                { id: 3, title: 'Meuble à vendre', price: 150, image: '/images/ad3.png' },
                { id: 4, title: 'Soutien scolaire', price: 20, image: '/images/ad4.png' },
                { id: 5, title: 'Colocation à partager', price: 300, image: '/images/ad5.png' },
            ],
        };
    },
};
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
    height: 150px;
    object-fit: cover;
}

.row {
    justify-content: space-between;
}

.col-md-2 {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 100%;
}
</style>