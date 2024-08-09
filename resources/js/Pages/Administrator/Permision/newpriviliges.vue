<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import Checkbox from '@/components/Checkbox.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
</script>

<template>
    <AuthenticatedLayout>
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-body">
              <form @submit.prevent="submitForm">
                <input type="hidden" name="requestid" :value="requestid">
                <input type="hidden" name="role_name" :value="role.name">
  
                <div class="row col-4">
                  <div class="form-group">
                    <InputLabel class="inputlabel">Role Name:</InputLabel>
                    <input type="text" :value="role.name" id="roleName" class="mt-1 block w-full" disabled />
                  </div>
                </div>
                <br>
                <label>
                  <Checkbox
                    name="selectAll"
                    id="selectAllDomainList"
                    v-model="selectAll"
                    @click="toggleAllPermissions"
                  />&nbsp;
                  <label class="form-check-label" style="color: black; margin-top:5px;" for="selectAllDomainList">Check All</label>
                </label>
                <br><br>
  
                <div class="material-datatables">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <tbody>
                      <tr v-for="module in permsWithModules" :key="module.module_name">
                        <td><b>{{ module.module_name }}</b></td>
                        <td v-for="permission in permissions.filter(p => p.module_name === module.module_name)" :key="permission.id">
                          <Checkbox
                            class="form-check-input"
                            style="border-color: black;"
                            :name="'permissions[]'"
                            :value="permission.id"
                            v-model="selectedPermissions"
                          /> &nbsp;
                          <label style="color: black; margin-top: 5px;"><b>{{ permission.name }}</b></label>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
  
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp; Submit</button>
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
    role: Object,
    permissions: Array,
    requestid: Number,
    rolePermissions: Array,
    permsWithModules: Array
  },
  data() {
    return {
      selectAll: false,
      selectedPermissions: this.rolePermissions
    };
  },
  methods: {
    toggleAllPermissions() {
      if (this.selectAll) {
        this.selectedPermissions = this.permissions.map(p => p.id);
      } else {
        this.selectedPermissions = [];
      }
    },
    async submitForm() {
        try {
        await this.$inertia.post('/saveprivilegies', {
          requestid: this.requestid,
          role_name: this.role.name,
          permissions: this.selectedPermissions
        });
      } catch (error) {
        console.error('Error updating privileges:', error);
      }
    }
  }
};

  </script>


  <style scoped>
  /* Add any necessary custom styles here */
  </style>
  