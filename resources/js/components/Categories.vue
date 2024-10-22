<template>
    <div class="categories my-5">
        <h2 class="text-center">Nos catégories</h2>
        <div class="d-flex justify-content-center text-center mt-5 flex-wrap">

            <router-link to="/colocation" class="category-item">
                <img src="../../../public/img/colocation.jpg" alt="Colocation"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Colocation</p>
            </router-link>

            <router-link to="/covoiturage" class="category-item">
                <img src="../../../public/img/covoiturage.jpg" alt="Covoiturage"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Covoiturage</p>
            </router-link>

            <router-link to="/vente-meubles" class="category-item">
                <img src="../../../public/img/vente_de_meubles.jpg" alt="Vente de meubles"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Vente de meubles</p>
            </router-link>

            <router-link to="/soutien-scolaire" class="category-item">
                <img src="../../../public/img/soutien_scolaire.png" alt="Soutien scolaire"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Soutien scolaire</p>
            </router-link>

        </div>
    </div>
</template>

<style scoped>
.categories {
    padding: 0 1rem;
}

.category-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-item {
    margin: 0.5rem;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.category-item p {
    color: black;
    margin-top: 0.5rem;
    font-size: 1.1rem;
}

/* Effet au survol */
.category-item:hover .category-img {
    transform: scale(1.1);
}

/* Responsive */
@media (min-width: 768px) {
    .category-img {
        width: 180px;
        height: 180px;
    }

    .category-item p {
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .category-img {
        width: 120px;
        height: 120px;
    }

    .category-item p {
        font-size: 1rem;
    }
}

.d-flex {
    gap: 2rem; 
    flex-wrap: wrap;
    justify-content: space-around;
}
</style>
