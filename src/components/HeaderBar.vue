<template>
  <div class="fixed w-full flex items-center justify-between h-[60px] bg-green-pri text-green-pri shadow px-5 z-10">
    <div class="container flex items-center pl-1">
      <div class="flex items-center"> <!-- Mostrado en todos los dispositivos -->
        <img :src="require('@/assets/Ministère.png')" alt="Logo" class="w-28 h-18 mr-2"
          style="width: 70px; height: 50px;">
        <h2 class="font-bold text-x text-gray-100 ">O-GECA APP</h2>
        <h2 class="font-bold text-x">Nombre de la</h2>
      </div>
      <div class="md:hidden flex items-center"> <!-- Se muestra solo en dispositivos pequeños -->
        <button id="menuBtn" @click="openSide()">
          <i class="fas fa-bars text-gray-100 text-lg"></i> <!-- Ícono de menú -->
        </button>
      </div>
    </div>
    <div class="space-x-5 pr-3">
      <div class="relative group">
        <button @click="dropdownBtn()"
          class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
          <i class="fa-regular fa-circle-user text-gray-500 text-lg pr-2"></i>
          <span class="text-gray-500 text-lg ml-2  md:flex hidden"><u> {{ nom }}</u></span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5  -mr-1" style="widows: 30px; height: 30px;"
            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
              d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </button>
        <div id="dropdown-menu"
          class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-2 space-y-1 w-48">
          <!-- Dropdown content goes here -->
          <RouterLink to="/profile" @click="dropdownBtn()"
            class="block text-gray-500 py-2.5 px-4 my-4 mt-0 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-pri hover:to-green-pri hover:text-white">
            <i class="fas fa-user  text-lg pr-4"></i>Mon Profile
          </RouterLink>
          <RouterLink to="/user" v-if="isAdmin" @click="dropdownBtn()"
            class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-pri hover:to-green-pri hover:text-white">
            <i class="fa-solid fa-users text-lg pr-4"></i>Utilisateur
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "@/_service/caller.service";
export default {
  name: 'HeaderBar',
  data() {
    return {
      nom: '',
      isOpen: false,
      isAdmin: false
    }
  },
  mounted() {
    try {
      const token = JSON.parse(localStorage.getItem("token"));
      if (token) {
        Axios.get('/auth/user').then(response => {
          this.nom = response.data.nom
          if (response.data.role == 'ADMIN') {
            this.isAdmin = true;
          }
        }).catch(error => {
          console.log("error dans l'axios: ", error)
          // localStorage.clear();
          // this.$router.push({ name: "Login" });
        })
      }
    } catch (error) {
      console.log(error)
    }
  },
  methods: {
    openSide() {
      const sideNav = document.getElementById('sideNav');
      sideNav.classList.toggle('hidden');
    },
    dropdownBtn() {
      const dropdownMenu = document.getElementById('dropdown-menu');
      this.isOpen = !this.isOpen;
      dropdownMenu.classList.toggle('hidden', !this.isOpen);
    }
  }
}
</script>