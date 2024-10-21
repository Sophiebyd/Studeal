<template>
    <footer class="footer">
        <div class="footer-container">
            <a href="/" class="footer-logo">
                <img src="../../../public/img/logo.png" alt="Logo" class="logo-img" />
            </a>

            <div class="footer-links">
                <a href="/conditions" class="text-decoration-none text-white me-4">Conditions générales</a>
                <a href="/contact" class="text-decoration-none text-white">Contact</a>
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