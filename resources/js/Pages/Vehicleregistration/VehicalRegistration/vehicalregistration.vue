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
                  <div class="col-12">
                        <Link class="btn btn-info fa-pull-right" :href="route('vehicalregistrationnew')"><i class="fas fa-plus mr-2"></i>Register New Vehical</Link>
                    </div>
                    <br>
                    <br>
                    <hr style="width:100%; height:1px; background-color:#000;">
                    <br>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>NIC</th>
                          <th>License No</th>
                          <th>Date Of Issue</th>
                          <th>Classes</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        
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
</script>
<style>
</style>