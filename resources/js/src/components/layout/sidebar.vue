<template>
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
        <nav ref="menu" id="sidebar">
            <div class="shadow-bottom"></div>

            <perfect-scrollbar class="list-unstyled menu-categories" tag="ul" :options="{
                wheelSpeed: 0.5,
                swipeEasing: !0,
                minScrollbarLength: 40,
                maxScrollbarLength: 300,
                suppressScrollX: true,
            }">
                <!-- Dashboard -->
                <router-link tag="li" to="/dashboard" class="menu" @click.native="toggleMobileMenu " >
                    <a class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>{{ $t('dashboard') }}</span>
                        </div>
                    </a>
                </router-link>

                <!-- Admins -->
                <li class="menu"  v-if="logged_user.role == 'admin'">
                    <a href="#admins" v-b-toggle class="dropdown-toggle" @click.prevent>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>{{ $t('admin') }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <b-collapse id="admins" accordion="menu">
                        <ul class="collapse submenu list-unstyled show">
                            <li v-if="logged_user.type == 'admin'">
                                <router-link tag="li" to="/admin/create"
                                    @click.native="toggleMobileMenu"><a>{{ $t('create') }}</a></router-link>
                            </li>

                            <router-link tag="li" to="/admin/view"
                                @click.native="toggleMobileMenu"><a>{{ $t('view') }}</a></router-link>
                        </ul>
                    </b-collapse>
                </li>

            

               

              



                <!-- Profile -->
                <router-link tag="li" to="/profile" class="menu" @click.native="toggleMobileMenu" v-if="logged_user.role == 'user'">
                    <a class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-clipboard">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            <span>{{ $t('profile') }}</span>
                        </div>
                    </a>
                </router-link>

            </perfect-scrollbar>
        </nav>
    </div>
    <!--  END SIDEBAR  -->
</template>

<script>
export default {
    props: ['main'],
    data() {
        return {
            menu_collapse: "dashboard",
            user_id: this.$userId,
            admins: [],
            logged_user: [],
            userType: '',
        };
    },

    watch: {
        $route(to) {
            const selector = document.querySelector(
                '#sidebar a[href="' + to.path + '"]'
            );
            const ul = selector.closest("ul.collapse");
            if (!ul) {
                const ele = document.querySelector(
                    ".dropdown-toggle.not-collapsed"
                );
                if (ele) {
                    ele.click();
                }
            }
        },
    },

    mounted() {
        // default menu selection on refresh
        const selector = document.querySelector(
            '#sidebar a[href="' + window.location.pathname + '"]'
        );
        if (selector) {
            const ul = selector.closest("ul.collapse");
            if (ul) {
                let ele = ul
                    .closest("li.menu")
                    .querySelectorAll(".dropdown-toggle");
                if (ele) {
                    ele = ele[0];
                    setTimeout(() => {
                        ele.click();
                    });
                }
            } else {
                selector.click();
            }
        }

        this.fetchAllUsers();
    },

    methods: {
        toggleMobileMenu() {
            if (window.innerWidth < 991) {
                this.$store.commit("toggleSideBar", true);
            }
        },

        //Fetch all the  users from the database
        fetchAllUsers() {
            axios
                .get("/admin/fetch/user")
                .then((res) => {
                    if (res.status == 200) {
                        this.admins = res.data;
                        for (let i = 0; i < this.admins.length; i++) {
                            if (this.admins[i].id == this.user_id) {
                                this.logged_user = this.admins[i]
                                return
                            }
                        }
                    }
                })
                .catch((err) => {
                    console.log("error:" + err);
                });
        },
    },
};
</script>
