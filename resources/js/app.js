import './bootstrap';
import 'flowbite';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Example from './components/Example.vue';
import LandingPage from './components/LandingPage.vue';
import ChildRecords from './components/ChildRecords.vue';


const app = createApp({
    components: {
        Example,
        LandingPage,
        ChildRecords,
    },
});


app.mount('#app');
