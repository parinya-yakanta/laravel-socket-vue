import './bootstrap';

import { createApp } from 'vue';

import CameraScanner from "./components/CameraScanner.vue";
import ExampleComponent from './components/ExampleComponent.vue';
import CctvComponent from './components/CctvComponent.vue';

const app = createApp({
  components: {
    'example-component': ExampleComponent,
    'camera-scanner': CameraScanner,
    'cctv-component': CctvComponent,
  },
});

app.mount('#app');
