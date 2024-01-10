<template>

     <info-box-link
        :link="'/docs/create'"
        :background="'bg-success'" :icon="'fas fa-file-alt'"
        :title="$t('general.crearDocumento')"
        :description="$t('general.crearDocumentoInfo')">
    </info-box-link>
</template>

  <script>
  import { ref } from 'vue';

  export default {
    props: {

    },

    setup(props) {


      return {

      };
    },
  };
  </script>

  <style scoped>

  </style>
