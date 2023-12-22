import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import { i18nVue } from 'laravel-vue-i18n';
import App from '../src/App.vue'


import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

app.component('ExampleComponent', ExampleComponent);

app.use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../lang/*.json');
        return await langs[`../lang/${lang}.json`]();
    }
}).mount('#app');
