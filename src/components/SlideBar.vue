<template>
  <div
    class="fixed flex flex-col justify-between top-14 left-0 w-25  md:w-56 md:flex hidden  bg-green-pri h-full text-white transition-all duration-300 border-none z-10 "
    id="sideNav">
    <nav>
      <ul class="space-y-3">
        <li class=" px-2">

          <RouterLink to="/"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fas fa-home mr-2"></i>Dashboard
          </RouterLink>

          <div class="bg-gradient-to-r from-green-font to-green-sec h-px mb-2"></div>

        </li>
        <li class=" px-2">
          <RouterLink to="/avancement"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fa-brands fa-atlassian"></i>
              <span>vancement</span>
          </RouterLink>
        </li>
        <li class=" px-2">
          
          <RouterLink to="/contractuel"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fa-solid fa-c"></i>
              <span>ontractuel</span>
          </RouterLink>
        </li>
        <li class=" px-2">
          <RouterLink to="/retraite"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fa-solid fa-r"></i>
              <span>etraite</span>
          </RouterLink>
        </li>

        <li class=" px-2">
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
            class="point block text-gray-100 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white mt-auto">
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
export default {
  name: "SlideBar",
  mounted() {
  },
  methods: {
    seDeconnect() {
      localStorage.clear();
      this.$router.push({ name: "Login" });
    },
  },
};
</script>

<style>
.point {
  cursor: pointer;
}
</style>