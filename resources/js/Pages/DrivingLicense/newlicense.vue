<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import Dropdown from '@/components/Dropdown.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
</script>

<template>
    <AuthenticatedLayout>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="savelicense">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">1.Surname</label>
                                            <TextInput type="text" v-model="licensedetails.surnname" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-6">
                                            <label class="inputlabel">2.Other Names</label>
                                            <TextInput type="text" v-model="licensedetails.othername" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-2">
                                            <label class="inputlabel">3.Date Of Birth</label>
                                            <TextInput type="date" v-model="licensedetails.dob" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">4a.Date of the Isuue</label>
                                            <TextInput type="date" v-model="licensedetails.doi" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">4b.Date of the Expiry</label>
                                            <TextInput type="text" v-model="licensedetails.doe" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">4b.NIC</label>
                                            <TextInput type="text" v-model="licensedetails.nic" class="mt-1 block w-full" aria-required="true" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">5.License No</label>
                                            <TextInput type="text" v-model="licensedetails.liceno" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-5">
                                            <label class="inputlabel">8.Permanent Place of Residence</label>
                                            <TextInput type="text" v-model="licensedetails.address" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">15.Sex</label>
                                            <TextInput type="text" v-model="licensedetails.sex" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">16.Height</label>
                                            <TextInput type="text" v-model="licensedetails.height" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-5">
                                            <label class="inputlabel">17.Weight</label>
                                            <TextInput type="text" v-model="licensedetails.weight" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">18.Eyes</label>
                                            <TextInput type="text"  v-model="licensedetails.eyes" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">9.Classes</label>
                                            <select class="form-select" multiple aria-label="Multiple select example" v-model="licensedetails.licensclasss">
                                                <option value="">Select Classes</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="CE">CE</option>
                                                <option value="D">D</option>
                                                <option value="DE">DE</option>
                                                <option value="G">G</option>
                                                <option value="J">J</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="formFile" class="form-label">Add a Photo for License</label>
                                            <input class="form-control" type="file" @change="handleFileUpload">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <PrimaryButton type="submit">
                                            <i class="fas fa-save"></i>&nbsp; Save
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            licensedetails:{
                userphoto: null,
                surnname: '',
                othername: '',
                dob: '',
                doi: '',
                doe: '',
                nic: '',
                liceno: '',
                address: '',
                sex: '',
                height: '',
                weight: '',
                eyes: '',
                licensclasss: '',
            }
        };
    },
    methods: {

        async  handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
            this.licensedetails.userphoto = file;
            console.log('Selected file:', file);
        }
    },
    async savelicense() {
        try {
            await this.$inertia.post('/storeuser', this.licensedetails);
            this.licensedetails = {
                userphoto: null,
                surnname: '',
                othername: '',
                dob: '',
                doi: '',
                doe: '',
                nic: '',
                liceno: '',
                address: '',
                sex: '',
                height: '',
                weight: '',
                eyes: '',
                licensclasss: '',
            };
        } catch (error) {
            console.error('Error saving role:', error);
        }
    },

    }
}
</script>
<style>

#officerphoto {
    margin-bottom: 10px;
    margin-top: 25px;
    margin-left: 65px;
}

#officerimg {
    width: 300px; /* Adjust the width as needed */
    height: 300px; /* Ensure it's a square */
    border-radius: 25px;
    border: 2px solid #000; /* Adjust the border color and width as needed */
}

#officerphoto {
  position: relative;
  display: inline-block;
  cursor: pointer;
  width: 300px; 
  height: 300px;
}

#officerimg {
  width: 100%;
  height: 100%;
  object-fit: cover; 

}

#imageofficerupload {
  display: none;
}

#officerphoto:hover #officerimg {
  opacity: 0.7;
}

.description {
  text-align: center;
  margin-top: 10px;
}
</style>