import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from '../views/dashboard/Dashboard.vue';
import store from '../store';

Vue.use(VueRouter);

const routes = [
    //dashboard
    { path: '/dashboard', name: 'Dashboard', component: Dashboard },

    //admin users
    {
        path: '/admin/create',
        name: 'create-admin',
        component: () => import(/* webpackChunkName: "users-profile" */ '../views/admin/CreateAdmins.vue')
    },
    {
        path: '/admin/view',
        name: 'view-admin',
        component: () => import(/* webpackChunkName: "users-account-setting" */ '../views/admin/ViewAdmins.vue')
    },

    

  

    //Organisation Profile
    {
        path: '/profile',
        name: 'organisation-profile',
        component: ()=> import('../views/organisation-profile/OrganisationProfile.vue')
    },

    //scan-qr
    {
        path: '/scan-qr',
        name: 'scan-qr-cod',
        component: ()=> import('../views/qr/QRScanner.vue')
    },

];

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    }
});

router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.layout && to.meta.layout == 'auth') {
        store.commit('setLayout', 'auth');
    } else {
        store.commit('setLayout', 'app');
    }
    next(true);
});

export default router;
