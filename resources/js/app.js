import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import { i18nVue } from 'laravel-vue-i18n';
import App from '../src/App.vue'


import ExampleComponent from './components/ExampleComponent.vue';
//Collective components
import InfoBoxLink from './components/info/InfoBoxLink.vue';
//Document Components
import DocumentIndexComponent from './components/document/DocumentIndexComponent.vue';
import DocumentCreateFormComponent from './components/document/DocumentCreateFormComponent.vue';

const app = createApp({});

app.component('ExampleComponent', ExampleComponent);

//Collective components
app.component('InfoBoxLink', InfoBoxLink);

//Document Components
app.component('DocumentIndexComponent', DocumentIndexComponent);
app.component('DocumentCreateFormComponent', DocumentCreateFormComponent);

app.use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../lang/*.json');
        return await langs[`../lang/${lang}.json`]();
    }
}).mount('#app');
