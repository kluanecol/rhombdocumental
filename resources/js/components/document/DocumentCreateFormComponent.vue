<template>
    <form>
        <div class="row bg-light">
            <div class="col-md-12 text-center text-navy p-2">
                <blockquote>
                    <h1>{{ $t("general.gestionNuevoDocumento") }}</h1>
                </blockquote>
            </div>

            <div class="col-lg-4 col-md-6 col-xs-12 form-group">



                <label for="process">{{ $t("general.proceso") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <select class="form-control" id="process" v-model="process">
                        <option value="process1">process 1</option>
                        <option value="process2">process 2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-xs-12 form-group">
                <label for="process">{{ $t("general.responsableFlujo") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <select class="form-control" id="responsable" v-model="responsable">
                        <option value="responsable1">Responsable 1</option>
                        <option value="responsable2">Responsable 2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-xs-12 form-group">
                <label for="system">{{ $t("general.sistema") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <select class="form-control" id="system" v-model="system">
                        <option value="system1">system 1</option>
                        <option value="system2">system 2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 form-group">
                <label for="process">{{ $t("general.razonNecesidad") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <textarea class="form-control" id="justification" v-model="justification"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 form-group">
                <label for="process">{{ $t("general.titulo") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="title" v-model="title" />
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 form-group">
                <label for="process">{{ $t("general.contenido") }}:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <textarea class="form-control" id="content" v-model="content"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 form-group">
                <label for="process">{{ $t("general.archivo") }}:</label>
                <div class="input-group">
                    <input type="file" class="form-control-file" id="archivo" required @change="handleFileUpload"
                        placeholder="holi" />
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block" @click="changeF()">
                {{ $t("buttons.guardar") }}
            </button>
        </div>
    </form>
</template>

<script >
import { ref } from "vue";
import { defineComponent } from "vue";

export default defineComponent({
    name: "DocumentCreateFormComponent",
    props: {},
    setup() {
        const justification = ref(0);

        const changeF = () => {
            justification.value++;
        }

        return {
            justification,
            changeF
        };
    },
});
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>
