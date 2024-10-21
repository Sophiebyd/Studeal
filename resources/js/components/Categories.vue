<template>
    <div class="categories my-5">
        <h2 class="text-center">Nos catégories</h2>
        <div class="d-flex justify-content-center text-center mt-5">
            <div class="category-item">
                <img src="../../../public/img/colocation.jpg" alt="Colocation"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Colocation</p>
            </div>

            <div class="category-item">
                <img src="../../../public/img/covoiturage.jpg" alt="Covoiturage"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Covoiturage</p>
            </div>
            <div class="category-item">
                <img src="../../../public/img/vente_de_meubles.jpg" alt="Vente de meubles"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Vente de meubles</p>
            </div>
            <div class="category-item">
                <img src="../../../public/img/soutien_scolaire.png" alt="Soutien scolaire"
                    class="img-thumbnail border-dark category-img" />
                <p class="mt-2">Soutien scolaire</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.category-img {
    width: 160px;
    height: 160px;
    object-fit: cover;
}

@media (min-width: 768px) {
    .category-img {
        width: 180px;
        height: 180px;
    }
}

.d-flex {
    gap: 1rem;
}

.category-item {
    margin-left: 0.5rem;
    margin-right: 0.5rem;
}
</style>