import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import App from '../src/App.vue'
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

app.component('ExampleComponent', ExampleComponent);

app.mount('#app');
