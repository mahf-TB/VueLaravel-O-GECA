<template>
    <div class="flex items-center justify-center h-screen" style="background: #edf2f7;">
        <!-- Reset Container -->
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div class="flex flex-col ">
                    <div class="md:space-y-2 mb-3 hidden">
                        <label class="text-xs font-semibold text-gray-600 py-2">
                            <img class="w-60" :src="require('@/assets/Ministère.png')" alt="" /><abbr class="hidden"
                                title="required">*</abbr></label>

                    </div>
                    <div class="flex flex-col sm:flex-row items-center mt-5 mb-5">
                        <h2 class="font-semibold text-lg mr-auto">Réinitialliser votre mot de passe</h2>
                        <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
                    </div>
                    <div class="mt-5">
                        <div class="form">

                            <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Matricule <abbr
                                            title="required">*</abbr></label>
                                    <input placeholder="Matricule" v-model="user.matricule"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="integration[shop_name]"
                                        id="integration_shop_name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Téléphone <abbr
                                            title="required">*</abbr></label>
                                    <input placeholder="Téléphone"  v-model="user.tel"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="integration[shop_name]"
                                        id="integration_shop_name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>

                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Nouveaux mot de passe<abbr
                                            title="required">*</abbr></label>
                                    <input placeholder="Nouveaux mot de passe"   v-model="user.motdepasse1"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="integration[shop_name]"
                                        id="integration_shop_name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Confirmation mot de passe<abbr
                                            title="required">*</abbr></label>
                                    <input placeholder="Confirmer votre mot de passe"  v-model="user.motdepasse2"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="integration[shop_name]"
                                        id="integration_shop_name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>

                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <button @click="retourne()"
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                    Annuler </button>
                                <button @click="onReset()"
                                    class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
    
<script>
import Axios from "@/_service/caller.service";

export default {
    name: 'Login',
    components: {

    },
    data() {
        return {
            user: {
                matricule: '',
                tel: '',
                motdepasse1:'',
                motdepasse2:''
            },
            toggle: false
        }
    },
    methods: {
        retourne(){
            this.$router.push("/login");
        },
        onToggle() {
            this.toggle = !this.toggle
        },
        async onReset() {
            var donnee = new FormData();
            console.log(this.user)
            if (this.user.nom != '' && this.user.motdepasse != '') {

                donnee.append('username', this.user.nom);
                donnee.append('password', this.user.motdepasse);

                Axios.post('/login.php?action=reset', donnee).then((res) => {
                    if (res.data.success) {
                        console.log("Success...!", res.data);
                        localStorage.setItem("token", JSON.stringify(res.data.token))
                        this.$router.push("/");
                    } else {
                        console.log("Error...!", res.data.message);
                    }
                }).catch((err) => {
                    console.log("error dans l'axios: ", err)
                })
            }
        },
    }

}
</script>
<style></style>