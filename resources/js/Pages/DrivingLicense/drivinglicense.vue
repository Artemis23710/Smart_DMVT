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
                        <Link class="btn btn-info fa-pull-right" :href="route('drivinglisencenew')"><i class="fas fa-plus mr-2"></i>Add New Driving License</Link>
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
                          <th>Role</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td class="text-right">
                            <button class="icon-button btn btn-success btn-sm mr-1" @click="editRole()" title="Edit">
                              <i class="material-icons">edit</i>
                            </button>
                            <form @submit.prevent="deleteRole()" style="display: inline;">
                              <button type="submit" class="icon-button btn btn-danger btn-sm mr-1" title="Delete">
                                <i class="material-icons">delete</i>
                              </button>
                            </form>
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
      
    },
    data() {
        return {
            roletask: {
                rolename: '',
                hiddenid: 1,
                recordID: ''
            }
        };
    },
    methods: {
        async saveroles() {
          try {
                await this.$inertia.post('/insertrole', this.roletask);
                this.roletask.rolename = '';
            } catch (error) {
                console.error('Error saving role:', error);
            }
        },
        editRole(role) {
          this.roletask.rolename = role.name;
          this.roletask.recordID = role.id;
          this.roletask.hiddenid = 2;
    },
      async deleteRole(roleId) {
        try {
          await this.$inertia.delete(`/roledelete/${roleId}`);
        } catch (error) {
          console.error('Error deleting role:', error);
        }
      }

    }
};
</script>
<style>
</style>