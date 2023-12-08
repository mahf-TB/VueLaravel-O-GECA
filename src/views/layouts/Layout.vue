<template>
    <!-- page -->
    <main class="flex flex-col h-screen bg-gray-100 text-gray-700" x-data="layout">

        <!-- header de la page -->
        <HeaderBar />

        <div class="flex-1 p-3 pt-[50px] flex-wrap bg-gray-100">

            <!-- SideBar de la page-->  
                <SideBar />
           
            <!-- container de la page -->
                <router-view />
            
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