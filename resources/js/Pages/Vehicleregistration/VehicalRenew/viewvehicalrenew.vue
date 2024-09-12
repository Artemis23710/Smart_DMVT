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
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">Class of Vehical</label>
                                            <select class="form-select"  v-model="vehicle.classofvehicle"  aria-label="Multiple select example" disabled >
                                                <option value="">Select Vehical Class</option>
                                                <option value="Motorcycles">Motorcycles (with or without sidecar)</option>
                                                <option value="Scooters">Scooters and mopeds</option>
                                                <option value="Private Motor Cars">Private Motor Cars</option>
                                                <option value="Dual Purpose Vehicles">Dual Purpose Vehicles</option>
                                                <option value="Three-wheelers">Three-wheelers (Tuk-tuks)</option>
                                                <option value="Light Goods Vehicles">Light Goods Vehicles (LGV)</option>
                                                <option value="Heavy Goods Vehicles">Heavy Goods Vehicles (HGV)</option>
                                                <option value="Private Passenger Vehicles">Private Passenger Vehicles</option>
                                                <option value="Public Passenger Vehicles">Public Passenger Vehicles (Omnibuses)</option>
                                                <option value="School Buses">School Buses</option>
                                                <option value="Trailers">Trailers</option>
                                                <option value="Ambulances">Ambulances</option>
                                                <option value="Fire Engines">Fire Engines</option>
                                                <option value="Hearses">Hearses</option>
                                                <option value="Road Construction Vehicles">Road Construction Vehicles</option>
                                                <option value="Heavy Motor Coaches">Heavy Motor Coache </option>
                                                <option value="Articulated Vehicles">Articulated Vehicles (Tractor-trailers)</option>
                                                <option value="Tractors">Tractors</option>
                                                <option value="Agricultural Trailers">Agricultural Trailers</option>
                                                <option value="Metered Taxis">Metered Taxis</option>
                                                <option value="Hire Cars">Hire Cars</option>
                                                <option value="Motor Lorries">Motor Lorries</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Registration No.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.registrationno"  aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Chassis No.</label>
                                            <TextInput type="text" class="mt-1 block w-full" v-model="vehicle.Chassisno" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-2">
                                            <label class="inputlabel">Date Of Registration.</label>
                                            <TextInput type="date"  class="mt-1 block w-full" v-model="vehicle.registerdate" aria-required="true" disabled/>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label class="inputlabel">Condition.</label>
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.condition" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Engine No.</label>
                                            <TextInput type="text" class="mt-1 block w-full"  v-model="vehicle.engineno" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Cylinder Capacity.</label>
                                            <TextInput type="text" class="mt-1 block w-full"  v-model="vehicle.capacity" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Fuel Type</label>
                                            <select class="form-select" aria-label="Multiple select example"   v-model="vehicle.fueltype" disabled>
                                                <option value="">Select Fuel Type</option>
                                                <option value="Diesal">Diesal</option>
                                                <option value="Petrol">Petrol</option>
                                                <option value="Other Fuel">Other Fuel</option>
                                                <option value="Electrical">Electrical</option>
                                            </select>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="inputlabel">Make.</label>
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.make" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Country of Origin</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.origincountry" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Year of Manufacture</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.manufactureyear" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Color.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.color" aria-required="true" disabled/>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">Current Owner Name.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.ownername" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Current Owner NIC.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.ownernic" aria-required="true" disabled/>
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Current Owner's Address.</label>
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.owneraddress"  aria-required="true" disabled/>
                                        </div>
                                    </div>
                                    <br>
                                    <h1 style="font-size:25px; text-align: center;">New Owner </h1>
                                    <hr>
                                    <br>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <input type="hidden" v-model="vehicle.hiddenid"/>
                                        <input type="hidden" v-model="vehicle.recordID"/>
                                        <input type="hidden" v-model="vehicle.ownerid"/>
                                      
                                    </div>
                                </div>
                            </div>
                        </form>
                       <br><br><br>
                       <h1 style="font-size:25px; text-align: center;">Former Owners </h1><hr>
                       <br>
                        <div class="material-datatables">
                            <div v-if="oldvehicleowners.length > 0" class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Owner Name</th>
                                            <th>Owner NIC</th>
                                            <th>Owner Address</th>
                                            <th>Owner Date Of Registration</th>
                                            <th>Owner Date Of Transfer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="oldvehicleowner in oldvehicleowners" :key="oldvehicleowner.id">
                                            <td>{{ oldvehicleowner.name }}</td>
                                            <td>{{ oldvehicleowner.nic }}</td>
                                            <td>{{ oldvehicleowner.address }}</td>
                                            <td>{{ oldvehicleowner.date_of_register }}</td>
                                            <td>{{ oldvehicleowner.date_of_transfer }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p v-else>No Old Vehicle Owners Available</p>

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
        vehicledetails: {
            type: Object,
            required: true,
        },
        vehicleowner: {
            type: Object,
            required: true,
        }, 
         oldvehicleowners: {
            type: Array,
            required: true,
        }
    },
    mounted() {
    console.log(this.oldvehicleowners); 
},
    data() {
        return {
            vehicle: Object.assign({
                classofvehicle: '',
                registrationno: '',
                Chassisno: '',
                registerdate: '',
                condition: '',
                engineno: '',
                capacity: '',
                fueltype: '',
                make: '',
                origincountry: '',
                manufactureyear: '',
                color: '',
                ownername: '',
                ownernic: '',
                owneraddress: '',
                hiddenid: '2',
                recordID: '',
                ownerid: this.vehicleowner.ownerID || '',
            }, this.vehicledetails)
        };
    },

}
</script>
<style>
</style>