<template>
    <div class="advantages-banner mt-3">
        <h1 class="advantages-title">Avantages de Stu'deal</h1>
        <div class="advantage-items d-flex justify-content-center text-center">
            <div class="advantage-item">
                <img src="../../../public/img/euro_logo.png" alt="Prix bas" class="advantage-icon" />
                <p>Prix bas</p>
            </div>
            <div class="advantage-item">
                <img src="../../../public/img/speed_logo.png" alt="Rapide" class="advantage-icon" />
                <p>Rapide</p>
            </div>
            <div class="advantage-item">
                <img src="../../../public/img/security_logo.png" alt="Sécurisé" class="advantage-icon" />
                <p>Sécurisé</p>
            </div>
            <div class="advantage-item">
                <img src="../../../public/img/share_logo.png" alt="Entraide" class="advantage-icon" />
                <p>Entraide</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.advantages-banner {
    background-color: #8B428F;
    padding: 2.2rem 0; 
    border-radius: 5px;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.advantages-title {
    margin-bottom: 1.6rem;
    font-size: 2.8rem; 
    text-align: center;
}

.advantage-items {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 6rem; 
    max-width: 100%;
}

.advantage-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.advantage-icon {
    width: 90px;
    height: 90px;
    margin-bottom: 10px;
}

.advantage-item p {
    margin: 0;
    font-size: 1.3rem;
}

/* responsives */

@media (max-width: 768px) {
    .advantage-items {
        flex-direction: column;
        gap: 2rem; 
    }

    .advantages-title {
        font-size: 2.2rem;
        margin-bottom: 1.2rem;
    }

    .advantage-icon {
        width: 80px;
        height: 80px;
    }

    .advantage-item p {
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .advantages-banner {
        height: auto;
        padding: 1.5rem 0; 
    }

    .advantages-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .advantage-items {
        flex-direction: column;
        gap: 1.5rem; 
    }

    .advantage-icon {
        width: 70px; 
        height: 70px;
    }

    .advantage-item p {
        font-size: 1.1rem;
    }
}
</style>
