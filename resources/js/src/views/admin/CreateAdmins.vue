<template>
    <div class="layout-px-spacing">
        <portal to="breadcrumb">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:;">{{$t('admins')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>{{$t('create')}}</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </portal>

        <!-- <div class="row layout-top-spacing">
            <div class="row col-12">

                <div class="statbox panel box box-shadow ml-3 mt-4">
                    <div class="row col-12">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget-two mt-3">
                                <div class="widget-content">
                                    <div class="w-numeric-value">
                                        <div class="w-content">
                                            <h3 class="w-value mx-4 my-3">Create an Admin</h3>
                                        </div>
                                    </div>
                                    
                                    <div style="margin: 50px">
                                        <div class="widget-content">
    
                                            <form method="POST" enctype="multipart/form-data">
                                                <div style="margin: 50px 50px 0">
    
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <label for="input_name">Full Name</label>
                                                            <input id="input_name" type="text" :class=" errors.full_name? 'form-control is-invalid' : 'form-control'" placeholder="Full name" v-model="full_name"/>
                                                            <small v-if="errors.full_name" class="text-danger">{{ errors.full_name[0] }}</small>
                                                        </div>
                                                        <div class="col">
                                                            <label for="input_email">Email</label>
                                                            <input id="input_email" type="email" :class=" errors.email? 'form-control is-invalid': 'form-control'" placeholder="Email" v-model="email"/>
                                                            <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                                                        </div>
                                                    </div>
    
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <label for="input_password">Password</label>
                                                            <input id="input_password" type="password" class="form-control" :class="errors.password? 'form-control is-invalid': 'form-control'" placeholder="Password" v-model="password"/>
                                                            <small v-if="errors.password" class="text-danger">{{errors.password[0]}}</small>
                                                        </div>
                                                        <div class="col">
                                                            <label for="input_confirm_password">Confirm Password</label>
                                                            <input id="input_confirm_password" type="password" class="form-control" placeholder="Confirm Password" v-model="password_confirmation"/>
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="input_file_image">Profile Image</label>
                                                            <input id="input_file_image" type="file" class="form-control" @change="onImageChange" />
                                                        </div>
                                                        <div class="col">
                                                            <b-form-group class="form-group" label="Select Admin Type">
                                                                <b-select v-model="type" size="md">
                                                                    <b-select-option value="Super Admin">Super Admin</b-select-option>
                                                                    <b-select-option value="Admin">Admin</b-select-option>
                                                                </b-select>
                                                                <small v-if="errors.type" class="text-danger">{{ errors.type[0] }}</small>
                                                            </b-form-group>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>

                                            <div class="d-flex mx-4 flex-row justify-content-end">
                                                <b-button v-if="!isLoading" variant="primary"  class="m-4" @click="createAdmin">Submit</b-button>
                                                <b-button v-else type="button" class="btn btn-primary m-4" disabled><span class="spinner-border text-white align-self-center loader-sm"></span></b-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div> -->

        <div class="container-fluid">
            <div class="row">
                <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                    <div class="statbox panel box box-shadow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4> {{$t('create_user')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <b-form>
                                <b-form-row class="mb-4">
                                    <b-form-group :label="$t('full_name')" class="col-md-6">
                                        <b-input type="text" :class="errors.full_name
                                            ? 'form-control is-invalid'
                                            : 'form-control'
                                            " :placeholder="$t('Ex_name')" v-model="full_name"></b-input>
                                        <small v-if="errors.full_name" class="text-danger">{{ errors.full_name[0] }}</small>
                        
                                    </b-form-group>
                                    <b-form-group :label="$t('email')" class="col-md-6">
                                        <b-input type="email" :class="errors.email
                                            ? 'form-control is-invalid'
                                            : 'form-control'
                                            " :placeholder="$t('Ex_email')" v-model="email"></b-input>
                                        <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                                    </b-form-group>
                                </b-form-row>

                                <b-form-row class="mb-4">
                                    <b-form-group class="col-md-6" :label="$t('admin_type')">
                                        <b-select v-model="type" :class="errors.type ? 'is-invalid' : ''
                                            ">
                                            <b-select-option value="Super Admin">{{$t('super_admin')}}</b-select-option>
                                            <b-select-option value="Admin">{{$t('admin')}}</b-select-option>
                                            <!-- <b-select-option value="Parent">Parent</b-select-option>
                                            <b-select-option value="Student">Student</b-select-option> -->
                                        </b-select>
                                        <small v-if="errors.type" class="text-danger">{{ errors.type[0] }}</small>
                                    </b-form-group>
                                    <b-form-group class="col-md-6">
                                        <label for="input_file_image">{{$t('profile_mage')}}</label>
                                        <input id="input_file_image" type="file" class="form-control"
                                            @change="onImageChange" accept="image/*" />
                                    </b-form-group>
                                </b-form-row>


                                <b-form-row class="mb-4">
                                    <b-form-group :label="$t('password')" class="col-md-6">
                                        <b-input type="password"
                                            :class="errors.password ? 'form-control is-invalid' : 'form-control'"
                                            :placeholder="$t('password')" v-model="password"></b-input>
                                        <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
                                    </b-form-group>
                                    <b-form-group :label="$t('confirm_password')" class="col-md-6">
                                        <b-input type="password"
                                            :class="errors.confirm_password ? 'form-control is-invalid' : 'form-control'"
                                            :placeholder="$t('confirm_password')" v-model="password_confirmation"></b-input>
                                        <small v-if="errors.confirm_password" class="text-danger">{{
                                            errors.confirm_password[0] }}</small>
                                    </b-form-group>
                                </b-form-row>
                                <!-- Additional fields for Student and Parent -->
                                <!-- <b-form-row v-if="type === 'Student' || type === 'Parent'
                                    " class="mb-4">
                                    <b-form-group label="Address" class="col-md-6">
                                        <b-input type="text" class="form-control" v-model="address"></b-input>
                                    </b-form-group>
                                    <b-form-group label="Telephone" class="col-md-6">
                                        <b-input type="text" class="form-control" v-model="telephone"></b-input>
                                    </b-form-group>
                                </b-form-row> -->

                                <b-form-row v-if="type === 'Student' || type === 'Parent'
                                    " class="mb-4">
                                    <b-form-group :label="$t('Date_of_Birth')" class="col-md-6">
                                        <b-input type="date" :class="errors.dob
                                            ? 'form-control is-invalid'
                                            : 'form-control'
                                            " placeholder="Ex: Jhone" v-model="dob" @change="onDobChange"></b-input>
                                        <small v-if="errors.dob" class="text-danger">{{ errors.dob[0] }}</small>
                                    </b-form-group>
                                    <b-form-group label="Age" class="col-md-6">
                                        <b-input type="number" :placeholder="$t('EX_age')" v-model="age" disabled></b-input>
                                        <small v-if="errors.age" class="text-danger">{{ errors.age[0] }}</small>
                                    </b-form-group>
                                </b-form-row>

                                <b-form-row class="mb-2" v-if="type === 'Student' || type === 'Parent'
                                    ">
                                    <b-form-group class="col-md-4" :label="$t('code')">
                                        <multiselect size="large" v-model="country_code" placeholder="select.."
                                            :options="countryCodes" :searchable="true"></multiselect>
                                        <small v-if="errors.country_code" class="text-danger">{{ errors.country_code[0]
                                        }}</small>
                                    </b-form-group>
                                    <b-form-group class="col-md-6" :label="$t('telephone_no')">
                                        <b-input type="tel" :class="errors.telephone
                                                ? 'form-control is-invalid'
                                                : 'form-control'
                                            " :placeholder="$t('EX_phone')" v-model="telephone"
                                            @change="onDobChange"></b-input>
                                        <small v-if="errors.telephone" class="text-danger">{{ errors.telephone[0] }}</small>
                                    </b-form-group>
                                    <b-form-group class="col-md-2" :label="$t('status')">
                                        <b-select value="" :class="errors.active
                                            ? 'is-invalid'
                                            : ''
                                            " v-model="active">
                                            <b-select-option value="1">{{$t('active')}}</b-select-option>
                                            <b-select-option value="0">{{$t('deactive')}}</b-select-option>
                                        </b-select>
                                    </b-form-group>
                                </b-form-row>

                                <b-form-row class="mb-2" v-if="type === 'Student' || type === 'Parent'
                                    ">
                                    <b-form-group :label="$t('address')" class="col">
                                        <b-input type="text"
                                            :class="errors.address ? 'form-control is-invalid' : 'form-control'"
                                            :placeholder="$t('EX_address')" v-model="address"></b-input>
                                        <small v-if="errors.address" class="text-danger">{{ errors.address[0] }}</small>
                                    </b-form-group>

                                </b-form-row>

                                <div class="d-flex flex-row justify-content-end">
                                    <b-button v-if="!isLoading" variant="primary" class="my-4"
                                        @click="createAdmin">{{$t('submit')}}</b-button>
                                    <b-button v-else type="button" class="btn btn-primary my-4" disabled><span
                                            class="spinner-border text-white align-self-center loader-sm"></span></b-button>
                                </div>
                            </b-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Importing necessary components
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";

export default {
    metaInfo: { title: "Create Admin" },

    components: {
        Multiselect,
    },

    data() {
        return {
            admins: [],
            email: null,
            full_name: null,
            password: null,
            password_confirmation: null,
            id: null,
            image: null,
            type: null,
            countryCodes: [
                "Algeria (+213)",
                "Andorra (+376)",
                "Angola (+244)",
                "Anguilla (+1264)",
                "Antigua and Barbuda (+1268)",
                "Argentina (+54)",
                "Armenia (+374)",
                "Aruba (+297)",
                "Australia (+61)",
                "Austria (+43)",
                "Azerbaijan (+994)",
                "Bahamas (+1242)",
                "Bahrain (+973)",
                "Bangladesh (+880)",
                "Barbados (+1246)",
                "Belarus (+375)",
                "Belgium (+32)",
                "Belize (+501)",
                "Benin (+229)",
                "Bangladesh (+880)",
                "Bermuda (+1441)",
                "Bhutan (+975)",
                "Bolivia (+591)",
                "Bosnia and Herzegovina (+387)",
                "Botswana (+267)",
                "Brazil (+55)",
                "Brunei (+673)",
                "Bulgaria (+359)",
                "Burkina Faso (+226)",
                "Burundi (+257)",
                "Cambodia (+855)",
                "Cameroon (+237)",
                "Canada (+1)",
                "Cape Verde (+238)",
                "Cayman Islands (+1345)",
                "Central African Republic (+236)",
                "Chile (+56)",
                "China (+86)",
                "Colombia (+57)",
                "Comoros (+269)",
                "Congo (+242)",
                "Cook Islands (+682)",
                "Costa Rica (+506)",
                "Croatia (+385)",
                "Cuba (+53)",
                "Cyprus (+357)",
                "Czech Republic (+42)",
                "Denmark (+45)",
                "Djibouti (+253)",
                "Dominica (+1809)",
                "Dominican Republic (+1809)",
                "Ecuador (+593)",
                "Egypt (+20)",
                "El Salvador (+503)",
                "Equatorial Guinea (+240)",
                "Eritrea (+291)",
                "Estonia (+372)",
                "Ethiopia (+251)",
                "Falkland Islands (+500)",
                "Faroe Islands (+298)",
                "Fiji (+679)",
                "Finland (+358)",
                "France (+33)",
                "French Guiana (+594)",
                "French Polynesia (+689)",
                "Gabon (+241)",
                "Gambia (+220)",
                "Georgia (+7880/995)",
                "Germany (+49)",
                "Ghana (+233)",
                "Gibraltar (+350)",
                "Greece (+30)",
                "Greenland (+299)",
                "Grenada (+1473)",
                "Guadeloupe (+590)",
                "Guam (+671)",
                "Guatemala (+502)",
                "Guinea (+224)",
                "Guinea-Bissau (+245)",
                "Guyana (+592)",
                "Haiti (+509)",
                "Honduras (+504)",
                "Hong Kong (+852)",
                "Hungary (+36)",
                "Iceland (+354)",
                "India (+91)",
                "Indonesia (+62)",
                "Iran (+98)",
                "Iraq (+964)",
                "Ireland (+353)",
                "Israel (+972)",
                "Italy (+39)",
                "Jamaica (+1876)",
                "Japan (+81)",
                "Jordan (+962)",
                "Kazakhstan (+7)",
                "Kiribati (+686)",
                "Kuwait (+965)",
                "Kyrgyzstan (+996)",
                "Laos (+856)",
                "Latvia (+371)",
                "Lebanon (+961)",
                "Lesotho (+266)",
                "Liberia (+231)",
                "Libya (+218)",
                "Liechtenstein (+417)",
                "Lithuania (+370)",
                "Luxembourg (+352)",
                "Macau (+853)",
                "Macedonia (+389)",
                "Madagascar (+261)",
                "Malawi (+265)",
                "Malaysia (+60)",
                "Maldives (+960)",
                "Mali (+223)",
                "Malta (+356)",
                "Marshall Islands (+692)",
                "Martinique (+596)",
                "Mauritania (+222)",
                "Mauritius (+230)",
                "Mexico (+52)",
                "Micronesia (+691)",
                "Moldova (+373)",
                "Monaco (+377)",
                "Mongolia (+976)",
                "Montserrat (+1664)",
                "Morocco (+212)",
                "Mozambique (+258)",
                "Myanmar (Burma) (+95)",
                "Namibia (+264)",
                "Nauru (+674)",
                "Nepal (+977)",
                "Netherlands (+31)",
                "New Caledonia (+687)",
                "New Zealand (+64)",
                "Nicaragua (+505)",
                "Niger (+227)",
                "Nigeria (+234)",
                "Niue (+683)",
                "Norfolk Island (+672)",
                "North Korea (+850)",
                "Northern Mariana Islands (+1670)",
                "Norway (+47)",
                "Oman (+968)",
                "Pakistan (+92)",
                "Palau (+680)",
                "Panama (+507)",
                "Papua New Guinea (+675)",
                "Paraguay (+595)",
                "Peru (+51)",
                "Philippines (+63)",
                "Poland (+48)",
                "Portugal (+351)",
                "Puerto Rico (+1787)",
                "Qatar (+974)",
                "Reunion (+262)",
                "Romania (+40)",
                "Russia (+7)",
                "Rwanda (+250)",
                "Saint Barthelemy (+590)",
                "Saint Helena (+290)",
                "Saint Kitts and Nevis (+1869)",
                "Saint Lucia (+1758)",
                "Saint Martin (+590)",
                "Saint Pierre and Miquelon (+508)",
                "Saint Vincent and the Grenadines (+1784)",
                "Samoa (+685)",
                "San Marino (+378)",
                "Sao Tome and Principe (+239)",
                "Saudi Arabia (+966)",
                "Senegal (+221)",
                "Serbia (+381)",
                "Seychelles (+248)",
                "Sierra Leone (+232)",
                "Singapore (+65)",
                "Slovakia (+421)",
                "Slovenia (+386)",
                "Solomon Islands (+677)",
                "Somalia (+252)",
                "South Africa (+27)",
                "Spain (+34)",
                "Sri Lanka (+94)",
                "Sudan (+249)",
                "Suriname (+597)",
                "Swaziland (+268)",
                "Sweden (+46)",
                "Switzerland (+41)",
                "Syria (+963)",
                "Taiwan (+886)",
                "Tajikistan (+992)",
                "Tanzania (+255)",
                "Thailand (+66)",
                "Togo (+228)",
                "Tokelau (+690)",
                "Tonga (+676)",
                "Trinidad and Tobago (+1868)",
                "Tunisia (+216)",
                "Turkey (+90)",
                "Turkmenistan (+993)",
                "Turks and Caicos Islands (+1649)",
                "Tuvalu (+688)",
                "Uganda (+256)",
                "Ukraine (+380)",
                "United Arab Emirates (+971)",
                "Uruguay (+598)",
                "US Virgin Islands (+1340)",
                "Uzbekistan (+998)",
                "Vanuatu (+678)",
                "Vatican City State (Holy See) (+379)",
                "Venezuela (+58)",
                "Vietnam (+84)",
                "Wallis and Futuna Islands (+681)",
                "Western Sahara (+212)",
                "Yemen (+967)",
                "Zambia (+260)",
                "Zimbabwe (+263)",
               
            ], // Assuming you have an array of country codes
            country_code: null,
            telephone: null,
            active: null,
            dob: null,
            age: null,
            address: null,

            errors: [],
            image_url: null,
            isLoading: false,
        };
    },

    mounted() {
        this.fetchAdmin();
        // Initialize your countryCodes array if needed
        // this.countryCodes = [...];
    },

    watch: {
        type(newType) {
            // Watch for changes in the 'type' property
            if (newType === 'Student' || newType === 'Parent') {
                // If type is 'Student' or 'Parent', set a default password
                const generatedPassword = Math.random().toString(36).slice(-8);
                this.password = generatedPassword;
                this.password_confirmation = generatedPassword;
            } else {
                // Reset the password fields for other types
                this.password = null;
                this.password_confirmation = null;
            }
        },
    },

    methods: {
        reset() {
            this.id = null;
            this.full_name = null;
            this.email = null;
            this.password = null;
            this.password_confirmation = null;
            this.image = null;
            this.type = null;
            this.country_code = null;
            this.telephone = null;
            this.active = null;
            this.dob = null;
            this.age = null;
            this.image_url = null;
            this.address = null;
        },

        // Fetch all the admin users from the database
        fetchAdmin() {
            axios
                .get("/admin/fetch/admin")
                .then((res) => {
                    if (res.status == 200) {
                        this.admins = res.data;
                    }
                })
                .catch((err) => {
                    console.log("error:" + err);
                });
        },

        // Create a new admin user
        createAdmin() {
            this.errors = [];
            this.isLoading = true;

            // Conditionally set the password
            if (this.type === 'Student' || this.type === 'Parent') {
                // Generate a random password for students and parents
                const generatedPassword = Math.random().toString(36).slice(-8);
                this.password = generatedPassword;
                this.password_confirmation = generatedPassword;
            }

            axios
                .post("/admin/create/admin", {
                    full_name: this.full_name,
                    email: this.email,
                    image: this.image,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    type: this.type,
                    country_code: this.country_code,
                    telephone: this.telephone,
                    active: this.active,
                    dob: this.dob,
                    age: this.age,
                    address: this.address,
                })
                .then((res) => {
                    console.log("Response:", res);
                    if (res.status === 200) {
                        if (res.data === 1) {
                            let successMessage = "Successfully created a User";

                            // Check user type and update the success message accordingly
                            if (this.type === 'Admin') {
                                successMessage = this.$t('Successfully_created_an_Admin');
                            } else if (this.type === 'Super Admin') {
                                successMessage = this.$t('Successfully_created_an_super_Admin');                            } else if (this.type === 'Student') {
                                successMessage = "Successfully created a Student";
                            } else if (this.type === 'Parent') {
                                successMessage = "Successfully created a Parent ";
                            }
                            console.log("Success Message:", successMessage);
                            Swal.fire({
                                icon: "success",
                                title: successMessage,
                                showConfirmButton: false,
                                timer: 1500,
                            });

                            // Reset form, fetch updated data, and update loading state
                            this.reset();
                            this.fetchAdmin();
                            this.isLoading = false;
                        } else {
                            // Handle other cases if res.data is not 1
                            // You may want to display an error message here
                            console.error("Error creating user:", res.data);
                        }
                    } else {
                        // Handle other cases if res.status is not 200
                        // You may want to display an error message here
                        console.error("Error creating user. Status:", res.status);
                    }
                })
                .catch((err) => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                    this.isLoading = false;
                });
        },


        onDobChange() {
            const dob = new Date(this.dob)

            //calculate month difference from current date in time  
            const month_diff = Date.now() - dob.getTime();

            //convert the calculated difference in date format  
            const age_dt = new Date(month_diff);

            //extract year from date      
            const year = age_dt.getUTCFullYear();

            //now calculate the age of the user  
            const age = Math.abs(year - 1970);

            this.age = age
        },

        // Image click process and image preview
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

        // Image click process and image preview
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    },
};
</script>
