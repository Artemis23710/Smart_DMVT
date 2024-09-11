<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import Dropdown from '@/components/Dropdown.vue';
import DropdownLink from '@/components/DropdownLink.vue';
import NavLink from '@/components/NavLink.vue';
import ResponsiveNavLink from '@/components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Topnav from '@/Layouts/Topnav.vue';
import Sidenav from '@/Layouts/Sidenav.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <Topnav />
        <Sidenav />
        <div class="container-fluid">
           <br>
          <slot />
             
          <div class="row">
        <div class="col-12">
            <div class="card" style=" height:78vh; max-height: 100%;">
                <div class="card-body">

                    <div class="search-container">

                        <img src="../../../public/Images/logo2.png" alt="Logo" class="search-logo">
                        <div class="search-bar">
                            <input type="text" id="search-field" class="search-input" placeholder="Search A Vehicle by Registration Number...">
                            <button id="search-button" class="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zm-5.44 1.528a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                
                    <br><br>
                    <div id="results-container" >
                        <div class="material-datatables" style="display: none;">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" >
                                <thead>
                                    <tr>
                                      <th>Officer Name</th>
                                      <th>Officer ID</th>
                                      <th>Gender</th>
                                      <th>Rank</th>
                                      <th>Division</th>
                                      <th>Assigned Station</th>
                                      <th>Contact</th>
                                      <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody id="results-body">
                                  </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>


<style scoped>
main {
    margin-left: 280px; /* Adjust this value if needed */
    padding-top: 1rem;
}

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