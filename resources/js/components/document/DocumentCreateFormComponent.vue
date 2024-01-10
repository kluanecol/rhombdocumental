<template>
    <form @submit.prevent="createDocument">
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

                <div v-if="v$.process.$error">
                    <p class="error"> <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $t("validation.requerido") }}
                    </p>
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
                <div v-if="v$.justification.$error" class="error">{{ v$.justification.$errors[0].$message }}</div>

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
                    <input type="file" class="form-control-file" id="file" placeholder="" />
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block">
                {{ $t("buttons.guardar") }}
            </button>
        </div>
    </form>
</template>

<script >
import { ref } from "vue";
import { defineComponent } from "vue";
import { useVuelidate } from '@vuelidate/core';
import { required, email as emailValidate, numeric, minLength, maxValue } from '@vuelidate/validators';

export default defineComponent({
    name: "DocumentCreateFormComponent",
    props: {},
    setup() {

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const justification = ref('');
        const process = ref('');

        const rules = {
            justification: { required },
            process: { required }
        };

        const v$ = useVuelidate(rules, {
            justification,
            process
        });

        const createDocument = async (event) => {


            if (v$.value.$invalid) {
                v$.value.$touch();
                console.log("No es válido");
                return;
            } else {
                try {
                    console.log(event.target.file.value);
                    const formData = new FormData();
                    formData.append('justification', justification);
                    formData.append('process', process);
                    formData.append('file', event.target.files);

                    const response = await fetch(`/docs/save`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });
                    const data = await response.json();
                    console.log(data, "POST");

                } catch (error) {
                    console.error('Error al consultar la información adicional:', error);
                }
            }
        };


        return {
            justification,
            process,
            v$,
            createDocument
        };
    },
});
</script>

<style scoped>
.error {
    color: red;
}
</style>
