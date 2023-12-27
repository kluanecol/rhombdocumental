<!-- En example-component.vue -->
<template>
    <div>
        <h1 style="color: #000;">{{ $t('Multilenguaje Activado') }}.</h1>
        <h2>{{ $t('Otro Mensaje Traducido') }}</h2>

        <ul>
            <li v-for="user in users" :key="user.id">
                {{ user.name }}
                <button @click="consultarInformacion(user)" class="btn btn-info mr-1">Consultar información</button>
                <button @click="verInformacion(user.id)" class="btn btn-warning mr-1">Ver</button>
                <button @click="verInformacionPost(user.id)" class="btn btn-success mr-1">Ver Post</button>
                <hr>
            </li><hr>
        </ul>

        <!-- Mostrar la información en la primera card -->
        <div v-if="informacionUsuario">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ informacionUsuario.name }}</h5>
                    <!-- Mostrar más detalles según sea necesario -->
                    <!-- Por ejemplo, {{ informacionUsuario.email }} o cualquier otra propiedad -->
                </div>
            </div>
        </div>

        <!-- Mostrar la información en la segunda card -->
        <div v-if="informacionAdicional">
            <div class="card mt-3">
                <div class="card-body">
                    <h1 class="card-title">{{ informacionAdicional.name }}</h1>
                    <h4>{{ informacionAdicional.email }}</h4>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'; // Importar la función ref desde vue

// Define la propiedad users
const props = defineProps(['users']);

// Propiedades para almacenar la información de los usuarios seleccionados
const informacionUsuario = ref(null);
const informacionAdicional = ref(null);

// Método para manejar la consulta de información
const consultarInformacion = (user) => {
    // Asignar la información del usuario seleccionado
    informacionUsuario.value = user;
};

// Método para manejar la acción "Ver"
const verInformacion = async (userId) => {
    // Realizar la consulta a la ruta get/info/{id}
    try {
        const response = await fetch(`/get/info/${userId}`);
        const data = await response.json();
        console.log(data.user.name);
        informacionAdicional.value = data.user;
    } catch (error) {
        console.error('Error al consultar la información adicional:', error);
    }
};

const verInformacionPost = async (userId) => {
    // Realizar la solicitud POST a la ruta get/info
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const response = await fetch(`/get/info`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: userId }),
        });
        const data = await response.json();
        console.log(data,"POST");
        // Asignar la información adicional del usuario
        informacionAdicional.value = data.user;
    } catch (error) {
        console.error('Error al consultar la información adicional:', error);
    }
};

</script>
