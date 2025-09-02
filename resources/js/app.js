/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

window.global = window;

import { createApp } from 'vue';
import VideoChat from './components/VideoChat.vue';
import './echo';
import './helpers';

const app = createApp({});
app.component('video-chat', VideoChat);
app.mount('#app');