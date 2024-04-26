<template>
  <div
    class="fixed flex flex-col justify-between top-14 left-0 w-25  md:w-56 md:flex   bg-green-pri h-full text-white transition-all duration-300 border-none z-10 "
    id="sideNav">
    <nav>
      <ul class="space-y-3">
        <li class=" px-2">
          <RouterLink to="/"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fas fa-home mr-2"></i>Tableau de Bord
          </RouterLink>
          <div class="bg-gradient-to-r from-green-font to-green-sec h-px mb-2"></div>
        </li>
        <li class=" px-2">
          <RouterLink to="/avancement"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <!-- <i class="fa-brands fa-atlassian"></i> -->
            <span>Changement de situation</span>
          </RouterLink>
        </li>
        <li class=" px-2">

          <RouterLink to="/contractuel"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <!-- <i class="fa-solid fa-c"></i> -->
            <span>Renouvellement de contrat</span>
          </RouterLink>
        </li>
        <li class=" px-2">
          <RouterLink to="/retraite"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <!-- <i class="fa-solid fa-r"></i> -->
            <span>Départ à la retraite</span>
          </RouterLink>
        </li>

        <li class=" px-2" v-if="isAdmin">
          <div class="bg-gradient-to-r from-green-font to-green-sec h-px mt-2 mb-2"></div>
          <RouterLink to="/import"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fa-solid fa-file-import mr-2"></i>Importer données
          </RouterLink>
        </li>


      </ul>

    </nav>
    <ul>
      <li class=" px-2">
        <div class="mb-[60px]">
          <a @click="seDeconnect()"
            class="block text-gray-100 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white mt-auto">
            <i class="fas fa-sign-out-alt mr-2"></i>Se déconnecter
          </a>

          <div class="bg-gradient-to-r from-green-font to-green-sec h-px mt-2"></div>
          <p class="mb-1 px-5 py-3 text-left text-xs text-green-sec">
            Copyright ZIFUKORO@2023
          </p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import Axios from "@/_service/caller.service";
import Swal from 'sweetalert2';
export default {
  name: "SlideBar",
  data(){
    return{
      isAdmin:false
    }
  },
  mounted() {
    Axios.get('/auth/user').then(response => {
          if (response.data.role == 'ADMIN') {
            this.isAdmin = true;
          }else{
            this.mb ='mb-0'
          }
        }).catch(error => {
          console.log("error dans l'axios: ", error)
          
        })
  },
  methods: {

    async seDeconnect() {
      const result = await Swal.fire({
        title: 'Se deconnecter du compte?',
        text: "Cette action est irréversible!",
        // icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Déconnexion'
      });
      if (result.isConfirmed) {
        localStorage.clear();
        this.$router.push({ name: "Login" });
      }
    },
  },
};
</script>

<style>
.point {
  cursor: pointer;
}
</style>