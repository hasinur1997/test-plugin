import { createApp } from 'vue';
import { __, sprintf } from '@wordpress/i18n';
import i18n from './mixins/i18n';
import App from './App.vue';
import router from './router';
import store from './store';

window.__ = __;
window.miusage = miusage;

const app = createApp( App );

app.mixin( i18n );
app.use( router );
app.use( store );

app.mount( '#app-miusage' );
