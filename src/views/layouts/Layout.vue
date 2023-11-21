<template>
    <!-- page -->
    <main class="flex flex-col h-screen bg-gray-100 text-gray-700" x-data="layout">

        <!-- header de la page -->
        <div class="fixed w-full flex items-center justify-between h-[60px] bg-green-pri text-green-pri shadow z-10">
            <HeaderBar />
        </div>
        <div class="flex-1 p-3 pt-[50px] flex-wrap bg-gray-100">

            <!-- SideBar de la page-->
            <div class="fixed flex flex-col justify-between top-14 left-0 w-25  md:w-64 md:flex hidden  bg-green-pri h-full text-white transition-all duration-300 border-none z-10 " id="sideNav">
             <SideBar />
            </div>
            <!-- container de la page -->
            <div class="mt-10 mb-10 md:ml-64">
               <router-view />
            </div>
        </div>
    </main>
</template>

<script>
import SideBar from "@/components/SlideBar.vue";
import HeaderBar from "@/components/HeaderBar.vue";
// import FooterBar from "@/components/FootNav.vue";
export default {
    name: 'Layout',
    components: {
        HeaderBar, SideBar
    }
}
</script> 