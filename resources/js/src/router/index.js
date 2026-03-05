import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from '../views/dashboard/Dashboard.vue';
import store from '../store';

Vue.use(VueRouter);

const routes = [
    //dashboard
    { path: '/dashboard', name: 'Dashboard', component: Dashboard },

    //admin users
    // {
    //     path: '/user/create',
    //     name: 'create-user',
    //     component: () =>
    //         import ( /* webpackChunkName: "users-profile" */ '../views/user/CreateUsers.vue')
    // },
    {
        path: '/user/view',
        name: 'view-user',
        component: () =>
            import ( /* webpackChunkName: "users-account-setting" */ '../views/user/ViewUsers.vue')
    },





    //user Profile
    {
        path: '/profile',
        name: 'user-profile',
        component: () =>
            import ('../views/user-profile/UserProfile.vue')
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