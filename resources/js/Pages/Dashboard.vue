<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="row">
        <div class="col-12">
            <div class="card" style=" height:78vh; max-height: 100%;">
                <div class="card-body">

                    <div class="search-container">

                        <img src="../../../public/Images/logo2.png" alt="Logo" class="search-logo">
                        <div class="search-bar">
                            <input type="text"  v-model="searchQuery"  class="search-input" placeholder="Search A Vehicle by Registration Number...">
                            <button id="search-button" @click="searchVehicle" class="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zm-5.44 1.528a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                
                    <br><br>
                    <div id="results-container" >
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" >
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
                                  <tbody id="results-body">

                                    <tr v-for="vehicle in searchResults" :key="vehicle.id">
                                        <td>{{ vehicle.id }}</td>
                                        <td>{{ vehicle.classofvehicle }}</td>
                                        <td>{{ vehicle.registration_No }}</td>
                                        <td>{{ vehicle.register_date }}</td>
                                        <td>{{ vehicle.color }}</td>
                                        <td>{{ vehicle.make }}</td>
                                        <td>{{ vehicle.ownername }}</td>
                                        <td>{{ vehicle.owneraddress }}</td>
                                        <td class="text-right">
                                            <Link :href="route('vehicleViewvehicle',{ id:vehicle.id })" class="icon-button btn btn-info btn-sm mr-1" title="Edit">
                                                <i class="material-icons">visibility</i>
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
    </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        vehicles: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            searchQuery: '',
            searchResults: this.vehicles
        };
    },
    methods: {

        async searchVehicle() {
            try {
                const formData = new FormData();
                formData.append('registration_no', this.searchQuery);

                const response = await this.$inertia.post('/vehiclesearch', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                // Access data correctly from Inertia's response
                this.searchResults = response.data.vehicles;

            } catch (error) {
            }
        }


    },
    watch: {
        vehicles(newVehicles) {
            this.searchResults = newVehicles; 
        }
    }
};
</script>
<style>
.search-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 50px 0;
    }
    
    .search-logo {
        width: 500px; 
        margin-bottom: 20px; 
    }
    
    .search-bar {
        display: flex;
        align-items: center;
    }
    
    .search-input {
        width: 500px;
        max-width: 100%;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 25px 0 0 25px;
        border: 1px solid #ccc;
        outline: none;
        transition: box-shadow 0.3s ease-in-out;
    }
    
    .search-input:focus {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #4285f4;
    }
    
    .search-btn {
        padding: 12px 20px;
        background-color: #4285f4;
        color: white;
        border-radius: 0 25px 25px 0;
        border: 1px solid #4285f4;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }
    

    .search-btn svg {
        width: 20px;
        height: 20px;
        fill: white;
    }
    
    .search-btn:hover {
        background-color: #357ae8;
    }
    
    @media (max-width: 768px) {
        .search-input {
            width: 100%; 
            border-radius: 25px; 
        }
    
        .search-btn {
            margin-top: 10px; 
            border-radius: 25px; 
            width: 100%; 
        }
    
        .search-bar {
            flex-direction: column; 
        }
    
        .search-logo {
            width: 120px;
        }
    }
    </style>
