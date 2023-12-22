import './bootstrap';

import {createApp} from 'vue'
import App from '../src/App.vue'
import ExampleComponent from '../src/components/ExampleComponent.vue'

const app = createApp(App);
app.component('example-component', ExampleComponent);
app.mount('#app');
