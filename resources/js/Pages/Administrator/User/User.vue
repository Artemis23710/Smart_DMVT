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
                    <form @submit.prevent="saveusers">
                        <div class="form-group">
                            <label class="inputlabel">Account Name</label>
                            <TextInput type="text" v-model="usertask.accountname" class="mt-1 block w-full" aria-required="true"/>
                            <label class="inputlabel">User Name</label>
                            <TextInput type="email" v-model="usertask.username" class="mt-1 block w-full" aria-required="true"/>
                            <label class="inputlabel">Password</label>
                            <TextInput type="password" v-model="usertask.password" class="mt-1 block w-full" aria-required="true"/>
                            <label class="inputlabel">Confirm Password</label>
                            <TextInput type="password" v-model="usertask.confirmpassword" class="mt-1 block w-full" aria-required="true"/>
                            <label class="inputlabel">Role</label>
                            <select v-model="usertask.roleid" class="form-select form-select-sm" aria-required="true">
                                <option value="">Select Role</option>
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>
                        <br>
                        <input type="hidden" v-model="usertask.hiddenid"/>
                        <input type="hidden" v-model="usertask.recordID"/>
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <PrimaryButton type="submit">
                                <i class="fas fa-save"></i>&nbsp; Save
                            </PrimaryButton>
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
                            <th>Account Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role.name }}</td>
                            <td class="text-right">
                                <button class="icon-button btn btn-success btn-sm mr-1" @click="editUser(user)" title="Edit">
                                <i class="material-icons">edit</i>
                                </button>
                                <form @submit.prevent="deleteUser(user.id)" style="display: inline;">
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
        users: Array,
        roles: Array
    },
    data() {
        return {
            usertask: {
                accountname: '',
                username: '',
                password: '',
                confirmpassword: '',
                roleid: '',
                hiddenid: '1',
                recordID: ''
            }
        };
    },
    methods: {
        async saveusers() {
          try {

            if (this.usertask.password !== this.usertask.confirmpassword) {
                   alert('Passwords do not match.');
                   return;
                }

              await this.$inertia.post('/storeuser', this.usertask);
                this.usertask = {
                    accountname: '',
                    username: '',
                    password: '',
                    confirmpassword: '',
                    roleid: '',
                    hiddenid: '',
                    recordID: ''
                };
            } catch (error) {
                console.error('Error saving role:', error);
            }
        },

        editUser(user) {
          this.usertask.accountname = user.name;
          this.usertask.username = user.email;
          this.usertask.roleid = user.role_id;
          this.usertask.recordID = user.id;
          this.usertask.hiddenid = 2;
    },
      async deleteUser(userId) {
        try {
          await this.$inertia.get(`/userstatus/${userId}/3`);
        } catch (error) {
          console.error('Error deleting role:', error);
        }
      }

    }
};
</script>
<style>
</style>