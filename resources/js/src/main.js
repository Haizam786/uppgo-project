require('../bootstrap');


import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';


//vue axios
import axios from 'axios'
window.axios = axios;

//bootstrap vue
import { BootstrapVue } from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
Vue.use(BootstrapVue);

//perfect scrollbar
import PerfectScrollbar from 'vue2-perfect-scrollbar';
Vue.use(PerfectScrollbar);

//vue-scrollactive
import VueScrollactive from 'vue-scrollactive';
Vue.use(VueScrollactive);

//vue-meta
import VueMeta from 'vue-meta';
Vue.use(VueMeta, {
    refreshOnceOnNavigation: true
});

import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';
window.Swal = swal;
Vue.use(VueSweetalert2);


//portal vue
import PortalVue from 'portal-vue';
Vue.use(PortalVue);

//vue-i18n
import i18n from './i18n';

Vue.config.productionTip = false;

// set default settings
import appSetting from './app-setting';
Vue.prototype.$appSetting = appSetting;
appSetting.init();

Vue.prototype.$userId = document.querySelector("meta[name='user_id']").getAttribute('content');


new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#app');
