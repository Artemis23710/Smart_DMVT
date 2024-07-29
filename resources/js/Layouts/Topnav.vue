<template>
    <nav class="top-nav">
      <div class="container">
        <a href="/" class="brand" style="margin-left:0px;">Smart DMVT</a>
        <ul class="nav-links">

          <li><a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" >
              <i class="material-icons">notifications</i>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
            </a>
          </li>

          <li>
            <button class="nav-link" @click="toggleFullscreen" id="screenchagebtn">
                    <i class="material-icons" v-if="!isFullscreen" id="fullscreen-icon">fullscreen</i>
                    <i class="material-icons" v-else id="exit-fullscreen-icon">fullscreen_exit</i>
            </button>
          </li>

          <li class="dropdown">
            <a href="#" class="dropbtn">
              <i class="material-icons" style="margin-right:5px;">person</i> {{ $page.props.auth.user.name }}
            </a>
            <div class="dropdown-content">
              <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
              <DropdownLink :href="route('logout')" method="post">Log Out</DropdownLink>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </template>

<script setup>
import { ref } from 'vue';
import Dropdown from '@/components/Dropdown.vue';
import DropdownLink from '@/components/DropdownLink.vue';
import NavLink from '@/components/NavLink.vue';
import ResponsiveNavLink from '@/components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);


const isFullscreen = ref(false);

function toggleFullscreen() {
  if (isFullscreen.value) {
    exitFullscreen();
  } else {
    enterFullscreen();
  }
  isFullscreen.value = !isFullscreen.value;
}

function enterFullscreen() {
  const docElem = document.documentElement;
  if (docElem.requestFullscreen) {
    docElem.requestFullscreen();
  } else if (docElem.webkitRequestFullscreen) { /* Safari */
    docElem.webkitRequestFullscreen();
  } else if (docElem.msRequestFullscreen) { /* IE11 */
    docElem.msRequestFullscreen();
  }
}

function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}

</script>


<style scoped>
.top-nav {
  background-color: rgb(0, 81, 119);
  color: #fff;
  padding: 10px 20px;
}

.top-nav .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.top-nav .logo-img {
  height: 40px;
  margin-right: 10px; 
}

.top-nav .brand {
  font-size: 24px;
  color: #fff;
  text-decoration: none;
}

.top-nav .nav-links {
  list-style: none;
  display: flex;
  gap: 15px;
}

.top-nav .nav-links a {
  color: #fff;
  text-decoration: none; 
  font-size: 18px;
}

.top-nav .nav-links a:hover {
  text-decoration: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  color: #fff;
  text-decoration: none; 
  font-size: 18px;
  display: flex;
  align-items: center;
}

.dropbtn .user-icon {
  margin-right: 5px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: rgb(0, 81, 119);
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: #fff;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #555;
  text-decoration: none; 
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  color: #b2fd03; 
}
.logo-img {
    height: 50px;
    color: white;
}
#screenchagebtn{
  margin-right: 20px;
  margin-top: 2px;
  width: 30px;
  height: 30px;
}
#screenchagebtn:hover{
  color: #b2fd03;
}
#navbarDropdownMenuLink{
  margin-top: 3px;
  margin-right: 20px;
}
#navbarDropdownMenuLink:hover{
  color: #b2fd03;
}

</style>
