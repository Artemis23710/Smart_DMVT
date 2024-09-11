<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
</script>

<template>
    <AuthenticatedLayout>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Class of Vehicle</th>
                                        <th>Registration No</th>
                                        <th>Date Of Registration</th>
                                        <th>Color</th>
                                        <th>Make</th>
                                        <th>Owners Name</th>
                                        <th>Owner's Address</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vehicale in vehicales" :key="vehicale.id">
                                        <td>{{ vehicale.id }}</td>
                                        <td>{{ vehicale.classofvehicle }}</td>
                                        <td>{{ vehicale.registration_No }}</td>
                                        <td>{{ vehicale.register_date }}</td>
                                        <td>{{ vehicale.color }}</td>
                                        <td>{{ vehicale.make }}</td>
                                        <td>{{ vehicale.ownername }}</td>
                                        <td>{{ vehicale.owneraddress }}</td>
                                        <td class="text-right">
                                            <Link :href="route('vehiclerenew', { id: vehicale.id })"
                                                class="icon-button btn btn-info btn-sm mr-1" title="Edit">
                                                <i class="material-icons">autorenew</i>
                                            </Link>
                                        </td>
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
       vehicales: Array
    },
    methods: {
      async deletelicense(licenseId) {
        try {
          await this.$inertia.get(`/vehicledelete/${licenseId}/3`);
        } catch (error) {
          console.error('Error deleting role:', error);
        }
      }

    }
};
</script>
<style>
</style>