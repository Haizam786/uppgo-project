<template>
     <div class="layout-px-spacing app-contacts">

        <portal to="breadcrumb">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">{{$t('admins')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>{{$t('view_list')}} </span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </portal>

        <div class="row layout-spacing layout-top-spacing" id="cancel-row">
            <div class="col-lg-12">
                <div class="panel-body searchable-container grid" >
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                            <form class="form-inline my-2 my-lg-0">
                                <div class="">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-search"
                                    >
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <b-input v-model.trim="search" class="product-search" v-on:keyup="searchAdmin()" :placeholder="$t('search') " />
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="searchable-items grid">

                        <div v-for="(admin, index) in admins" class="items" :key="index">
                            <div class="item-content">
                                <div class="user-profile">
                                    <img v-if="admin.image_path" width="90" height="90" :src="'/storage/admins/'+ admin.image_path" alt="avatar" />
                                    <img v-else width="90" height="90" :src="require(`@/assets/images/dummy_profile.png`)" alt="avatar" />
            
                                    <div class="user-meta-info">
                                        <p class="user-name" style="font-size: 16px;">{{ admin.name }}</p>
                                    </div>
                                </div>
                                <div class="user-email">
                                    <p class="info-title">{{$t('email')}}:</p>
                                    <p class="usr-email-addr"> 
                                        <a :href="'mailto:'+admin.email">{{ admin.email }}</a>
                                    </p>
                                </div>

                                <div class="user-location">
                                    <p class="info-title">{{$t('phone')}}:</p>
                                    <p class="usr-ph-no">+1 (530) 555-12121</p>
                                </div>
                                <div class="user-location">
                                    <p class="info-title">{{$t('created_at')}}:</p>
                                    <p class="usr-email-addr"> 
                                        {{ admin.created_date }}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="user-phone" v-if="admin.type == 'Super Admin'">
                                        <b-badge variant="outline-secondary" class="outline-badge-secondary mr-1">{{$t('super_admin')}} </b-badge>
                                    </div>
                                    <div class="user-phone" v-else>
                                        <b-badge variant="outline-warning" class="outline-badge-warning mr-1">{{$t('admin')}}</b-badge>
                                    </div>
                                </div>
                                <div v-if="logged_user.type == 'Super Admin'" class="action-btn">
                                    <a href="javascript:;" class="mr-1" 
                                    @click="setToUpdate(admin.id, admin.name, admin.email, admin.active, admin.type);
                                    $bvModal.show('editModal');"
                                    v-b-tooltip.hover :title="$t('edit')">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-edit-2 edit"
                                        >
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>
                                    <a href="javascript:;" @click="destroyAdmin(admin.id)" v-b-tooltip.hover :title="$t('delete')">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-user-minus delete"
                                        >
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <b-modal id="editModal" hide-footer cancel-only :title="$t('edit_admin')">
            <form class="mt-0" enctype="multipart/form-data">
                <div class="form-group">
                    <b-form-group class="form-group" :label="$t('full_name')">
                        <b-input value="Name" v-model="edit_name"></b-input>
                        <small v-if="errors.full_name" class="text-danger">{{ errors.full_name[0] }}</small>
                    </b-form-group>

                    <b-form-group class="form-group" :label="$t('email')">
                        <b-input value="Email" v-model="edit_email"></b-input>
                        <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                    </b-form-group>

                    <div class="mx-1 mb-2">
                        <label for="input_file_image_admin">{{$t('image')}}</label>
                        <input
                            id="input_file_image_admin"
                            type="file"
                            class="form-control"
                            @change="
                                onImageChange
                            "
                        />
                    </div>

                    <img v-if="image_url" :src="image_url" width="100%" height="100%" />

                    <b-form-group class="form-group" :label="$t('Select_Type')">
                        <b-select v-model="edit_type" size="sm">
                            <b-select-option value="Super Admin"> {{$t('super_admin')}}</b-select-option>
                            <b-select-option value="Admin">{{$t('admin')}}</b-select-option>
                        </b-select>
                        <small v-if="errors.type" class="text-danger">{{ errors.type[0] }}</small>
                    </b-form-group>

                    <b-form-group class="form-group" :label="$t('Select_Status')">
                        <b-select v-model="edit_active" size="sm">
                            <b-select-option value="1">{{$t('active')}}</b-select-option>
                            <b-select-option value="0">{{$t('deactive')}}</b-select-option>
                        </b-select>
                        <small v-if="errors.active" class="text-danger">{{ errors.active[0] }}</small>
                    </b-form-group>

                </div>
            </form>

            <div class="d-flex flex-row-reverse ">
                <b-button variant="success"  class="m-3" @click="updateAdmin">{{$t('done')}}</b-button>
                <b-button id="edit_cancel" variant="outline-danger" class="m-3" data-dismiss="modal" @click="$bvModal.hide('editModal')"><i class="flaticon-cancel-12"></i> {{$t('cancel')}}</b-button>
            </div>

        </b-modal>
        <!--  End Model -->
    </div>
</template>

<style scoped>
    .searchable-container .switch {
        width: 600px;
        height: auto;
    }
    .searchable-container .searchable-items.grid .items .user-profile .custom-checkbox {
        display: none !important;
    }
</style>



<script>
    import '@/assets/sass/apps/contacts.scss';

export default {
    metaInfo: { title: 'View Admins' },

        
    data() {
        return {
            admins: [],
            user_id: this.$userId,
            logged_user : [],

            id: null,
            name: null,
            email: null,
            image: null,
            type: null,
            active: null,

            edit_id: null,
            edit_name: null,
            edit_email: null,
            edit_image: null,
            edit_type: null,
            edit_active: null,

            search: null,
            file: null,
            image_url: null,

            errors: [],
        };
    },

    mounted() {
        this.fetchAdmin();
    },

    methods: {
        reset() {
            this.admins = [];
            this.logged_user = [];

            this.search = null;
            this.image_url = null;

            this.id = null;
            this.name = null;
            this.email = null;
            this.active = null;
            this.type = null;
        },


        setToUpdate(id, name, email, active, type) {
            this.edit_id = id;
            this.edit_name = name;
            this.edit_email = email;
            this.edit_active = active;
            this.edit_type = type;

            this.image_url = null;
        },

        //Fetch all the admin users from the database
        fetchAdmin() {
            axios
                .get("/admin/fetch/admin")
                .then((res) => {
                    if (res.status == 200) {
                        this.admins = res.data;
                        for(let i = 0; i < this.admins.length; i++){
                            if(this.admins[i].id == this.user_id){
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

        //image click proccess and image preview
        onImageChange(e) {
            this.image = e.target.files[0];
            this.image_url = URL.createObjectURL(this.image);

            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = (e) => {
                this.imagepreview = e.target.result;
            };

            let files = e.target.files || e.dataTransfer.files;

            if (!files.length) return;

            this.createImage(files[0]);
        },

        //image click proccess and image preview
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        //handle search
        searchAdmin() {
            axios
                .post("/admin/filter/search-admin", {
                    search: this.search,
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.admins = res.data;
                        console.log(res.data);
                    }
                })
                .catch((err) => {});
        },

        //edit an admin user
        updateAdmin() {
            axios
                .put("/admin/update/admin", {
                    id: this.edit_id,
                    full_name: this.edit_name,
                    email: this.edit_email,
                    active: this.edit_active,
                    type: this.edit_type,
                    image: this.image
                })
                .then((res) => {
                    if (res.status == 200 && res.data == 1) {
                        
                        $("#edit_cancel").click();


                        this.reset();
                        this.fetchAdmin();
                        

                        Swal.fire({
                            icon: "success",
                            title: this.$t('Successfully_Updated'),
                            showConfirmButton: false,
                            timer: 1500,
                        });
                            
                    } else {
                        Swal.fire(
                            this.$t('error'),
                            this.$t('Admin_update_unsuccessfull'),
                            this.$t('error')
                        );
                      
                    }
                })
                .catch((err) => {
                    if (err.response.status == 422)
                    this.errors = err.response.data.errors

                        Swal.fire({
                            title: this.$t('error'),
                            icon: 'error',
                            showConfirmButton: false,
                            timer:1000,
                        })


                        $("#edit_cancel").click();
                        this.$bvModal.show('editModal');
                });
        },

        //Deleting an admin user   //title: "(Delete a Admin) Are you sure?",
        destroyAdmin(id) {
            Swal.fire({
                title: this.$t('D_A_are_you_sure'),
                text: this.$t('You_wont_be_able_to_revert_this'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: this.$t('delete_it'),
                cancelButtonText: this.$t('cancel')
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(this.$t('deleted'), this.$t('Admin_has_been_deleted'), this.$t('success'));

                    axios
                        .post("/admin/destroy/admin", {
                            id: id,
                        })
                        .then((res) => {
                            if (res.status == 200 && res.data == 1) {
                                Swal.fire(
                                    this.$t('deleted'),
                                    this.$t('Admin_has_been_deleted'),
                                    this.$t('success')
                                );

                                // this.reset();
                                this.fetchAdmin();
                            } else {
                                Swal.fire(
                                    this.$t('error'),
                                    this.$t('Admin_destroy_unsuccessfull'),
                                    this.$t('error')
                                );
                            }
                        })
                        .catch((err) => {
                            if (err.response.status == 422) {
                                // this.errors = err.response.data.errors;
                                Swal.fire(
                                    this.$t('error'),
                                    this.$t('Admin_destroy_unsuccessfull'),
                                    this.$t('error')
                                );
                            }
                        });
                }
            });
        },
    },
};
</script>
