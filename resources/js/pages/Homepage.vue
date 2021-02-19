<template>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2">
                    <div>
                        
                        <form @submit.prevent="handleSubmit">
                             <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" v-model="user.firstName" id="firstName" name="firstName" class="form-control" :class="{ 'is-invalid': submitted && $v.user.firstName.$error }" />
                                <div v-if="submitted && !$v.user.firstName.required" class="invalid-feedback">First Name is required</div>
                            </div>


                           
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" v-model="user.email" id="email" name="email" class="form-control" :class="{ 'is-invalid': submitted && $v.user.email.$error }" />
                                <div v-if="submitted && $v.user.email.$error" class="invalid-feedback">
                                    <span v-if="!$v.user.email.required">Email is required</span>
                                    <span v-if="!$v.user.email.email">Email is invalid</span>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" v-model="user.phone" id="phone" name="phone" class="form-control" :class="{ 'is-invalid': submitted && $v.user.phone.$error }" />
                                <div v-if="submitted && !$v.user.phone.required" class="invalid-feedback">Phone is required</div>
                            </div>

                             <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" v-model="user.address" id="address" name="address" class="form-control" :class="{ 'is-invalid': submitted && $v.user.address.$error }" />
                                <div v-if="submitted && !$v.user.address.required" class="invalid-feedback">Address is required</div>
                            </div>

                            <div class="form-group">
                                <label for="zipcode">Zipcode</label>
                                <input type="text" v-model="user.zipcode" id="zipcode" name="zipcode" class="form-control" :class="{ 'is-invalid': submitted && $v.user.zipcode.$error }" />
                                <div v-if="submitted && !$v.user.zipcode.required" class="invalid-feedback">Zipcode is required</div>
                            </div>

                            <div class="form-group">
                                <label for="profile">Profile</label>
                                <input type="file" v-on:change="handleProfileUpload" id="profile" name="profile" class="form-control" :class="{ 'is-invalid': submitted && $v.user.profile.$error }" />
                                <div v-if="submitted && !$v.user.profile.required" class="invalid-feedback">Profile is required</div>
                            </div>

                             <div class="form-group">
                                <label for="license">License doc</label>
                                <input type="file" v-on:change="handleLicenseUpload" id="license" name="license" class="form-control" :class="{ 'is-invalid': submitted && $v.user.license.$error }" />
                                <div v-if="submitted && !$v.user.license.required" class="invalid-feedback">License doc is required</div>
                            </div>

                          
                            <div class="form-group">
                                <button class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { required, email, minLength, sameAs } from "vuelidate/lib/validators";

    export default {
        name: "app",
        data() {
            return {
                user: {
                    firstName: "",
                    email: "",
                    phone: "",
                    address: "",
                    zipcode: "",
                    profile: "",
                    license: "",
                   
                },
                submitted: false
            };
        },
        validations: {
            user: {
                firstName: { required },
                email: { required, email },
                phone: { required },
                address: { required },
                zipcode: { required },
                profile: { required },
                license: { required },
               
            }
        },
        methods: {
        handleProfileUpload(ev){

        this.user.profile = ev.target.files[0]
        console.log(this.user.profile,'userprofile')
        },
        handleLicenseUpload(ev){
        this.user.license = ev.target.files[0];
        console.log(this.user.license,'user license')

        },
            handleSubmit(e) {
                this.submitted = true;

                // stop here if form is invalid
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }
                 let data = new FormData();
                 console.log(this.user.profile,'userprofile')
                 data.append('user_profile', this.user.profile)
                  data.append('license_doc', this.user.license)
                  data.append('name', this.user.firstName)
                  data.append('email', this.user.email)
                  data.append('phone', this.user.phone)
                  data.append('address', this.user.address)
                  data.append('zipcode', this.user.zipcode)
                     axios.post('public/api/save_user', data, )
                           .then((response) => {
                           console.log(response)
                           alert(response.data.message)
                            })
                            .catch((error) => {
                            console.log(error)
                            alert(response.data.message)
                     })
 
            }
        }
    };
</script>