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
             
        </div>
    </div>
</template>


<style scoped>
main {
    margin-left: 280px; /* Adjust this value if needed */
    padding-top: 1rem;
}
</style>