<template>
    <div class="layout-px-spacing">
        <portal to="breadcrumb">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">{{$t('organisation')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>{{$t('profile')}}</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </portal>

        <div class="row layout-spacing">
            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
                <div class="user-profile layout-spacing">
                    <div class="panel">
                        <div class="panel-body" v-for="org in organisation">
                            <div class="d-flex justify-content-between">
                                <h3 class="">{{$t('profile')}}</h3>
                                <a @click="setToUpdate(org.id, org.name, org.bank_name, org.account_no, org.swift_code, org.country, org.email, org.address, org.telephone); $bvModal.show('editProfileModal');" class="mt-2 edit-profile">
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
                                        class="feather feather-edit-3"
                                    >
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="text-center user-info">
                                <div v-if="org.logo">
                                    <img
                                        :src="'/storage/profile/'+ org.logo"
                                        alt="..."
                                        height="160px"
                                        width="180px"
                                    />
                                </div>

                                <div v-else>
                                    <img
                                        src="@/assets/images/dummy_profile.png"
                                        alt="..."
                                        height="160px"
                                        width="180px"
                                    />
                                </div>
                                <p class="">{{ org.name }}</p>
                            </div>
                            <div class="user-info-list">
                                <div class="">
                                    <ul class="contacts-block list-unstyled">
                                        
                                        <li class="contacts-block__item">
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
                                            class="feather feather-map-pin"
                                            >
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle></svg
                                            >{{ org.address }}
                                        </li>

                                        <li class="contacts-block__item">
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
                                                class="feather feather-coffee"
                                            >
                                                <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                                <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                                <line x1="6" y1="1" x2="6" y2="4"></line>
                                                <line x1="10" y1="1" x2="10" y2="4"></line>
                                                <line x1="14" y1="1" x2="14" y2="4"></line>
                                            </svg>
                                            {{ org.country }}
                                        </li>

                                        <li class="contacts-block__item">
                                            <a :href="'mailto:'+org.email">
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
                                                        class="feather feather-mail"
                                                    >
                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                        <polyline points="22,6 12,13 2,6"></polyline></svg>
                                                    {{ org.email }}
                                            </a>
                                        </li>
                                        <li class="contacts-block__item">
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
                                                class="feather feather-phone"
                                            >
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                                ></path>
                                            </svg>
                                            {{ org.telephone }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Modal -->
                 <b-modal id="editProfileModal" hide-footer cancel-only :title="$t('Edit_Profile')">
                        <form class="mt-0" enctype="multipart/form-data">
                            <div >

                                <div class="row m-2">
                                    <label for="org_name">{{$t('organisation_name')}}</label>
                                    <input
                                        id="org_name"
                                        type="text"
                                        :class="
                                            errors.name
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                        "
                                        placeholder="First Name"
                                        v-model="
                                            edit_name
                                        "
                                    />
                                    <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="input_profile_email">{{$t('email')}}</label>
                                    <input id="input_profile_email" type="email" :class="errors.address
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                                "
                                        v-model="
                                            edit_email
                                        "
                                    />
                                    <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="input_address">{{$t('address')}}</label>
                                    <input id="input_address" type="text" :class="errors.address
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                                "
                                        placeholder="Address"
                                        v-model="
                                            edit_address
                                        "
                                    />
                                    <small v-if="errors.address" class="text-danger">{{errors.address[0]}}</small>
                                </div>
                                
                                <div class="row m-2">
                                    <label for="input_telephone">{{$t('telephone_no')}}</label>
                                    <input id="input_telephone" type="tel" :class="errors.telephone
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                                "
                                        placeholder="Telephone"
                                        v-model="
                                            edit_telephone
                                        "
                                    />
                                    <small v-if="errors.telephone" class="text-danger">{{errors.telephone[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="org_bank_name">{{$t('bank_name')}}</label>
                                    <input
                                        id="org_bank_name"
                                        type="text"
                                        :class="
                                            errors.name
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                        "
                                        v-model="
                                            edit_bank_name
                                        "
                                    />
                                    <small v-if="errors.bank_name" class="text-danger">{{errors.bank_name[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="org_account_no">{{$t('account_number')}}</label>
                                    <input
                                        id="org_account_no"
                                        type="number"
                                        :class="
                                            errors.name
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                        "
                                        v-model="
                                            edit_account_no
                                        "
                                    />
                                    <small v-if="errors.account_no" class="text-danger">{{errors.account_no[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="org_swift_code">{{$t('swift_code')}}</label>
                                    <input
                                        id="org_swift_code"
                                        type="number"
                                        :class="
                                            errors.name
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                        "
                                        v-model="
                                            edit_swift_code
                                        "
                                    />
                                    <small v-if="errors.swift_code" class="text-danger">{{errors.swift_code[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="org_country">{{$t('country')}}</label>
                                    <input
                                        id="org_country"
                                        type="text"
                                        :class="
                                            errors.name
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                        "
                                        v-model="
                                            edit_country
                                        "
                                    />
                                    <small v-if="errors.country" class="text-danger">{{errors.country[0]}}</small>
                                </div>

                                <div class="row m-2">
                                    <label for="input_file_image_customer">{{$t('logo')}}</label>
                                    <input
                                        id="input_file_image_customer"
                                        type="file"
                                        class="form-control"
                                        @change="
                                            onImageChange
                                        "
                                    />
                                </div>

                                <img v-if="image_url" class="mt-2 mb-4" :src="image_url" width="100%" height="100%" />

                            </div>
                        </form>

                        <div class="d-flex flex-row-reverse ">
                            <b-button variant="success"  class="m-3" @click="editProfile">{{$t('done')}}</b-button>
                            <b-button id="edit_cancel" variant="outline-danger" class="m-3" data-dismiss="modal" @click="$bvModal.hide('editProfileModal')"><i class="flaticon-cancel-12"></i>{{$t('cancel')}}</b-button>
                        </div>

                </b-modal>
                <!--  End Model -->
            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                <div class="education layout-spacing ">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="">{{$t('activity_logs')}}</h3>
                            <div class="timeline-alter" style="height: 300px; overflow-y: scroll;">
                                
                                <div v-for="activity in activities" class="item-timeline">
                                    <div class="t-meta-date">
                                        <p class="">{{ activity.created_date }}</p>
                                    </div>
                                    <div class="t-dot"></div>
                                    <div class="t-text">
                                        <p>{{ activity.activity }}</p>
                                        <p><b> {{ activity.user_name }}</b></p>
                                    </div>
                                </div>
                                
                            </div>  
                            
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
                <div class="skills layout-spacing ">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="">Skills</h3>

                            <b-progress variant="primary" :min="0" :max="100" show-progress class="br-30">
                                <b-progress-bar :value="25" :label-html="`<div class='progress-title'><span>PHP</span><span>25%</span></div>`"></b-progress-bar>
                            </b-progress>
                            <b-progress variant="primary" :min="0" :max="100" show-progress class="br-30">
                                <b-progress-bar :value="50" :label-html="`<div class='progress-title'><span>Wordpress</span><span>50%</span></div>`"></b-progress-bar>
                            </b-progress>
                            <b-progress variant="primary" :min="0" :max="100" show-progress class="br-30">
                                <b-progress-bar :value="70" :label-html="`<div class='progress-title'><span>Javascript</span><span>70%</span></div>`"></b-progress-bar>
                            </b-progress>
                            <b-progress variant="primary" :min="0" :max="100" show-progress class="br-30">
                                <b-progress-bar :value="60" :label-html="`<div class='progress-title'><span>jQuery</span><span>60%</span></div>`"></b-progress-bar>
                            </b-progress>
                        </div>
                    </div>
                </div>

                <div class="bio layout-spacing ">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="">Bank Details</h3>

                            <div class="bio-skill-box">
                                <div class="row">
                                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                        <div class="d-flex b-skills">
                                            <div></div>
                                            <div class="">
                                                <h5>Bank Name</h5>
                                                <p>{{ organisation[0].bank_name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                        <div class="d-flex b-skills">
                                            <div></div>
                                            <div class="">
                                                <h5>Account Number</h5>
                                                <p>{{ organisation[0].account_no }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">
                                        <div class="d-flex b-skills">
                                            <div></div>
                                            <div class="">
                                                <h5>Swift Code</h5>
                                                <p>{{ organisation[0].swift_code }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">
                                        <div class="d-flex b-skills">
                                            <div></div>
                                            <div class="">
                                                <h5>Country</h5>
                                                <p>{{ organisation[0].country }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>



<script>
        import '@/assets/sass/scrollspyNav.scss';
        import '@/assets/sass/users/user-profile.scss';


        export default {
            metaInfo: { title: 'Profile' },

            data() {
                return {
                    organisation: [{}],
                    activities: [],
                    errors: [],

                    logo: null,
                    image_url: null,

                    edit_id: null,
                    edit_name: null,
                    edit_bank_name: null,
                    edit_account_no: null,
                    edit_swift_code: null,
                    edit_country: null,
                    edit_email: null,
                    edit_address: null,
                    edit_telephone: null,
                    edit_logo: null,

                };
            },

            mounted() {
                this.fetchOrganisations()
                this.fetchActivites()
            },
            methods: {
                //Fetch all organisation details from db
                fetchOrganisations(){
                    axios
                        .get("/admin/fetch/organisations")
                        .then( (res) => {
                            if (res.status == 200) {
                                this.organisation = res.data;
                            }
                        }).catch((err) => {
                            console.log("error:" + err);
                        });
                },

                //Fetch all activities details from db
                fetchActivites(){
                    axios
                        .get("/admin/fetch/activities")
                        .then( (res) => {
                            if (res.status == 200) {
                                this.activities = res.data;
                                      
                            }
                        }).catch((err) => {
                            console.log("error:" + err);
                        });
                },

                reset(){
                    this.organisation = [];
                    this.activities = [];

                    this.image_url = null;
                },

                //function to populate the edit model
                setToUpdate(id, name,bank_name, account_no, swift_code, country, email, address, telephone){
                    this.edit_id = id;
                    this.edit_name = name;
                    this.edit_bank_name = bank_name;
                    this.edit_account_no = account_no;
                    this.edit_swift_code = swift_code;
                    this.edit_country = country;
                    this.edit_email = email;
                    this.edit_address = address;
                    this.edit_telephone = telephone;
                    console.log(this.edit_name)
                    this.image_url = null;
                },

                //image click proccess and image preview
                onImageChange(e) {
                    this.logo = e.target.files[0];
                    this.image_url = URL.createObjectURL(this.logo);

                    let reader = new FileReader();
                    reader.readAsDataURL(this.logo);
                    reader.onload = (e) => {
                        this.imagepreview = e.target.result;
                    };

                    let files = e.target.files || e.dataTransfer.files;

                    if (!files.length) return;

                    this.createImage(files[0]);
                },

                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.logo = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                //Edit a customer
                editProfile() {

                    axios
                        .put("/admin/update/profile", {
                            id: this.edit_id,
                            name: this.edit_name,
                            bank_name: this.edit_bank_name,
                            account_no: this.edit_account_no,
                            swift_code: this.edit_swift_code,
                            country: this.edit_country,
                            email: this.edit_email,
                            address: this.edit_address,
                            telephone: this.edit_telephone,
                            logo: this.logo
                        })
                        .then((res) => {
                            if (res.status == 200 && res.data == 1) {
                                
                                $("#edit_cancel").click();

                                this.reset();
                                this.fetchOrganisations();
                                
                                Swal.fire({
                                    icon: "success",
                                    title: this.$t('Successfully_Updated'),
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            } else {
                                Swal.fire(
                                    this.$t('error'),
                                    this.$t('profile_update_unsuccessfull'),
                                    this.$t('error')
                                );
                            }
                        })
                        .catch((err) => {
                            if (err.response.status == 422)
                                // this.uerrors = err.response.data.errors;

                                Swal.fire(
                                    this.$t('error'),
                                    this.$t('profile_update_unsuccessfull'),
                                    this.$t('error')
                                );
                        });
                },
            }

        };
</script>