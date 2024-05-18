import './bootstrap';

import { createApp } from 'vue';

import CameraScanner from "./components/CameraScanner.vue";
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({
  components: {
    'example-component': ExampleComponent,
    'camera-scanner': CameraScanner,
  },
});

app.mount('#app');
