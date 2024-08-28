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
            <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <form @submit.prevent="saveroles">
                    <div class="form-group">
                      <label class="inputlabel">Role Name</label>
                     <TextInput  type="text" class="mt-1 block w-full" aria-required="true"/>
                    </div>
                    <br>
                    <input type="hidden" />
                    <input type="hidden" />
                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <PrimaryButton type ="submit" > <i class="fas fa-save"></i>&nbsp; Save</PrimaryButton>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-9">
              <div class="card">
                <div class="card-body">
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