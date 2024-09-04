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
                        <form @submit.prevent="savelicense" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">1.Surname</label>
                                            <TextInput type="text" v-model="licensedetails.surname" class="mt-1 block w-full" aria-required="true" />
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
                                            <TextInput type="date" v-model="licensedetails.doe" class="mt-1 block w-full" aria-required="true" />
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
                                            <label class="inputlabel">9. Classes</label>
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
                                        <div class="col-4">
                                            <label class="inputlabel">4a.Date of Renew</label>
                                            <TextInput type="date" v-model="licensedetails.daterenew" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <input type="hidden" v-model="licensedetails.hiddenid"/>
                                        <input type="hidden" v-model="licensedetails.recordID"/>
                                        <PrimaryButton type="submit">
                                            <i class="fas fa-save"></i>&nbsp; Save
                                        </PrimaryButton>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label id="officerphoto">
                                                <img :src="userPhotoUrl" id="officerimg" name="officerimg" alt="Current Officer Image" />
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
          <br><br>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Of Issue</th>
                                <th>Date Of Expire</th>
                                <th>Classes</th>
                                <th>Date Of Renew</th>
                            </tr>
                        </thead>
                      <tbody>
                        <tr v-for="licensesrenew in licensesrenews" :key="licensesrenew.id">
                              <td>{{ licensesrenew.id }}</td>
                              <td>{{ licensesrenew.date_of_issue }}</td>
                              <td>{{ licensesrenew.date_of_expire }}</td>
                              <td>{{ licensesrenew.classes }}</td>
                              <td>{{ licensesrenew.date_of_renew }}</td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        license: {
            type: Object,
            required: true,
        },
        licensesrenews: Array
    },
    data() {
        return {
            licensedetails: Object.assign({
                userphoto: '',
                surname: '',
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
                licensclasss: [], 
                hiddenid: '2',
                recordID: '',
                daterenew: '',
            }, this.license)
        };
    },
    computed: {
        userPhotoUrl() {
            return this.licensedetails.userphoto 
                ? `/storage/Photos/Licensephoto/${this.licensedetails.userphoto}`
                : '/Images/avatar.jpg'; 
        }
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
            const formData = new FormData();
                for (const key in this.licensedetails) {
                    formData.append(key, this.licensedetails[key]);
                }
                await this.$inertia.post('/savelisencerenew', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                Object.assign(this.licensedetails, {
                    userphoto: '',
                    surname: '',
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
                    licensclasss: [],  
                    hiddenid: '2',
                    recordID: '',
                    daterenew: '',
                });
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