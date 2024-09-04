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
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>NIC</th>
                                <th>License No</th>
                                <th>Date Of Issue</th>
                                <th>Date Of Expire</th>
                                <th>Classes</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                      <tbody>
                        <tr v-for="license in licenses" :key="license.id">
                              <td>{{ license.id }}</td>
                              <td>{{ license.surname }} {{ license.othername }}</td>
                              <td>{{ license.nic }}</td>
                              <td>{{ license.license_no }}</td>
                              <td>{{ license.date_of_issue }}</td>
                              <td>{{ license.date_of_expire }}</td>
                              <td>{{ license.classes }}</td>
                              <td class="text-right">
                                <Link :href="route('lisencerenew', { id: license.id })" class="icon-button btn btn-info btn-sm mr-1" title="Renew">
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
        licenses: Array
    }
};
</script>
<style>
</style>