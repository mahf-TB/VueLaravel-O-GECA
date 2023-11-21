<template>
    <nav>
        <RouterLink to="/"
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fas fa-home mr-2"></i>Dashboard
        </RouterLink>

        <div class="bg-gradient-to-r from-green-font to-green-sec h-px mb-2 "></div>

        <ul class="space-y-3">
            <li class="opcion-con-desplegable px-2">
                <div
                    class="flex items-center justify-between p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec">
                    <div class="flex items-center">
                        <i class="fa-brands fa-atlassian "></i>
                        <span>vancement</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                <ul class="desplegable ml-4 hidden">
                    <li>
                        <RouterLink to="/avancement"
                            class="block p-2 text-gray-100  rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Liste Compléte
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/avancement"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Avancement bientot
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/avancement"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Avancement retard
                        </RouterLink>
                    </li>
                </ul>
            </li>
            <li class="opcion-con-desplegable px-2">
                <div
                    class="flex items-center justify-between p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec">
                    <div class="flex items-center">
                        <i class="fa-solid fa-c "></i>
                        <span>ontractuel</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                <ul class="desplegable ml-4 hidden">
                    <li>
                        <RouterLink to="/contractuel"
                            class="block p-2 text-gray-100  rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Liste Compléte
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/contractuel"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Contrat dans 6mois
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/contractuel"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Contrat retard
                        </RouterLink>
                    </li>
                </ul>
            </li>
            <li class="opcion-con-desplegable px-2">
                <div
                    class="flex items-center justify-between p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec">
                    <div class="flex items-center">
                        <i class="fa-solid fa-r "></i>
                        <span>etraite</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                <ul class="desplegable ml-4 hidden">
                    <li>
                        <RouterLink to="/retraite"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Retraiter dans 12mois
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/retraite"
                            class="block p-2 text-gray-100 rounded transition duration-200 hover:bg-green-sec flex items-center">
                            <i class="fas fa-chevron-right mr-2 text-xs"></i>
                            Retraiter retard
                        </RouterLink>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="bg-gradient-to-r from-green-font to-green-sec h-px mt-2 mb-2 "></div>
        <a
            class="block text-gray-100 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white">
            <i class="fa-solid fa-file-import mr-2"></i>Importer données
        </a>
    </nav>
    <div class="mb-[60px]">
        <a @click="seDeconnect()"
            class="point block text-gray-100 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-green-sec hover:to-green-sec hover:text-white mt-auto">
            <i class="fas fa-sign-out-alt mr-2"></i>Se déconnecter
        </a>

        <div class="bg-gradient-to-r from-green-font to-green-sec h-px mt-2"></div>
        <p class="mb-1 px-5 py-3 text-left text-xs text-green-sec">Copyright ZIFUKORO@2023</p>
    </div>
</template>
<script>
export default {
    name: 'SlideBar',
    mounted() {
        this.DOMLoanded()
    },
    methods: {
        seDeconnect() {
            localStorage.clear();
            this.$router.push({ name: 'Login' });
        },
        DOMLoanded() {
            const opcionesConDesplegable = document.querySelectorAll(".opcion-con-desplegable");
            opcionesConDesplegable.forEach(function (opcion) {
                opcion.addEventListener("click", function () {
                    const desplegable = opcion.querySelector(".desplegable");
                    desplegable.classList.toggle("hidden");
                });
            });
        }
    },
}
</script>

<style>
.point {
    cursor: pointer;
}
</style>