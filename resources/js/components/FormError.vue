<script setup>
const props = defineProps(['messages'])

console.log(props.messages);
</script>

<template>
    <div class="form-error" v-for="msg in props.messages" :key="msg">{{ msg }}</div>
</template>
