<template>
    <footer class="footer">
        <div class="footer-container">
            <router-link to="/" class="footer-logo">
                <img src="../../../public/img/Logo.png" alt="Logo" class="logo-img" />
            </router-link>

            <div class="footer-links">
                <router-link to="/condition" class="text-decoration-none text-white">Conditions générales</router-link>
                <router-link to="/contact" class="text-decoration-none text-white">Contact</router-link>
            </div>
        </div>
    </footer>
</template>

<script>
export default {};
</script>

<style scoped>
.footer {
    background-color: #8B428F;
    height: 1.5cm;
    width: 100%;
    position: relative;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding-right: 20px;
    box-sizing: border-box;
    height: 100%;
}

.logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    margin: 0;
}

.footer-links {
    display: flex;
}

.footer a {
    font-family: 'Meiryo', sans-serif;
    font-size: 0.9rem;
    color: white;
    margin-left: 20px;
}
</style>
