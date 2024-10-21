<script setup>
    defineProps(['messages'])
</script>

<template>
    <div class="form-error" v-for="msg in messages">{{ msg }}</div>
</template>