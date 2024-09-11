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
                                            <select class="form-select"  v-model="vehicle.classofvehicle"  aria-label="Multiple select example" >
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
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.registrationno"  aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Chassis No.</label>
                                            <TextInput type="text" class="mt-1 block w-full" v-model="vehicle.Chassisno" aria-required="true" />
                                        </div>
                                        <div class="col-2">
                                            <label class="inputlabel">Date Of Registration.</label>
                                            <TextInput type="date"  class="mt-1 block w-full" v-model="vehicle.registerdate" aria-required="true" />
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label class="inputlabel">Condition.</label>
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.condition" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Engine No.</label>
                                            <TextInput type="text" class="mt-1 block w-full"  v-model="vehicle.engineno" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Cylinder Capacity.</label>
                                            <TextInput type="text" class="mt-1 block w-full"  v-model="vehicle.capacity" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Fuel Type</label>
                                            <select class="form-select" aria-label="Multiple select example"   v-model="vehicle.fueltype">
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
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.make" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Country of Origin</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.origincountry" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Year of Manufacture</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.manufactureyear" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Color.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.color" aria-required="true" />
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">Owners Name.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.ownername" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Owners NIC.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" v-model="vehicle.ownernic" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Owner's Address.</label>
                                            <TextInput type="text"  class="mt-1 block w-full"  v-model="vehicle.owneraddress"  aria-required="true" />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <input type="hidden" v-model="vehicle.hiddenid"/>
                                        <input type="hidden" v-model="vehicle.recordID"/>
                                        <input type="hidden" v-model="vehicle.ownerid"/>
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
    props: {
        vehicledetails: {
            type: Object,
            required: true,
        },
        vehicleowner: {
            type: Object,
            required: true,
        }
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

    methods: {
    async savelicense() {
        try {
            const formData = new FormData();
                for (const key in this.vehicle) {
                    formData.append(key, this.vehicle[key]);
                }
                await this.$inertia.post('/savevehicalregistration', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

            this.licensedetails = {
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
                owneraddress: ''
            };
        } catch (error) {
            console.error('Error saving role:', error);
        }
    },

    }
}
</script>
<style>
</style>