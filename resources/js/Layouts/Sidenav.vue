<template>
    <nav class="custom-navbar">
      <div class="container">
        <ul class="nav-list">
          <li class="nav-item">
            <a class="nav-link" :href="route('dashboard')"><i class="material-icons">grid_view</i> Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#"><i class="material-icons">widgets</i> Modules</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="material-icons">view_module</i> Component</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#"><i class="material-icons">build</i> Features</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#"><i class="material-icons">apps</i> Applications</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#"><i class="material-icons">admin_panel_settings</i> Administrator</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </template>

<script>
export default {
    name: 'Sidenav',
};
</script>

<style scoped>
    .custom-navbar {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 0.5rem 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-navbar .container {
    display: flex;
    }

    .nav-list {
    list-style-type: none;
    display: flex;
    margin: 0;
    padding: 0;
    }

    .nav-item {
    position: relative;
    }

    .nav-link {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #333;
    }

    .nav-link:hover {
    background-color: #e9ecef;
    }

    .nav-link .material-icons {
    margin-right: 5px;
    }

    .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
    list-style-type: none;
    padding: 0.5rem 0;
    margin: 0;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    }

    .dropdown-item {
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #333;
    display: block;
    }

    .dropdown-item:hover {
    background-color: #e9ecef;
    }

    .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    }
</style>