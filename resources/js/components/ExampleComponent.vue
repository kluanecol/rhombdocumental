<!-- En example-component.vue -->
<template>
    <div>
        <h1 style="color: #000;">{{ $t('Multilenguaje Activado') }}.</h1>
        <h2>{{ $t('Otro Mensaje Traducido') }}</h2>

        <ul>
            <li v-for="user in users" :key="user.id">{{ user.name }}</li>
        </ul>
    </div>
</template>

<script setup>
// Define la propiedad users
const props = defineProps(['users']);
</script>
