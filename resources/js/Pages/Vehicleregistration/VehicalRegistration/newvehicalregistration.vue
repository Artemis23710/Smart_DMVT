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
                                            <select class="form-select"  aria-label="Multiple select example" >
                                                <option value="">Select Vehical Class</option>
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
                                        <div class="col-3">
                                            <label class="inputlabel">Registration No.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Chassis No.</label>
                                            <TextInput type="text" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-2">
                                            <label class="inputlabel">Date Of Registration.</label>
                                            <TextInput type="date"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label class="inputlabel">Condition.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Engine No.</label>
                                            <TextInput type="text" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Cylinder Capacity.</label>
                                            <TextInput type="text" class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Fuel Type</label>
                                            <select class="form-select" aria-label="Multiple select example" >
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
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Country of Origin</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Year of Manufacture</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-3">
                                            <label class="inputlabel">Color.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">Owners Name.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Owners NIC.</label>
                                            <TextInput type="text"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Owner's Address.</label>
                                            <TextInput type="date"  class="mt-1 block w-full" aria-required="true" />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <input type="hidden" />
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
</script>
<style>
</style>