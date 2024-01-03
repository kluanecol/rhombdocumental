<!-- InfoBoxLink.vue -->
<template>
    <div class="col-lg-4 col-md-4 col-xs-6">
      <a :href="link">
        <div class="info-box">
          <span class="info-box-icon" :class="background"><i :class="icon"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">{{ title }}</span>
            <span class="info-box-number">{{ description }}</span>
          </div>
        </div>
      </a>
    </div>
  </template>

  <script>
  import { ref } from 'vue';

  export default {
    props: {
      link: String,
      background: String,
      icon: String,
      title: String,
      description: String
    },

    setup(props) {
      const link = ref(props.link);
      const background = ref(props.background);
      const icon = ref(props.icon);
      const title = ref(props.title);
      const description = ref(props.description);

      return {
        link,
        background,
        icon,
        title,
        description,
      };
    },
  };
  </script>

  <style scoped>

  </style>
