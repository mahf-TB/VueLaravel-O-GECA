<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Changer votre Mot de passe" :style="{ width: '35rem' }"
            :breakpoints="{ '1199px': '70vw', '750px': '90vw' }">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                <form @submit.prevent="ChangeUserInfo()">

                    <!-- Acien -->
                    <label for="password1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Ancien Mot de passe</label>
                    <div class="relative  mt-2">
                        <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <rect x="3" y="5" width="18" height="14" rx="3" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                                <line x1="7" y1="15" x2="7.01" y2="15" />
                                <line x1="11" y1="15" x2="13" y2="15" />
                            </svg>
                        </div>
                        <input id="password1" name="password1" autocomplete="new-password"   v-model="password.old_pass" type="password" required :class="error.class1"
                            class="text-gray-600 focus:outline-none focus:border focus:border-green-pri font-normal w-full h-10 flex items-center pl-16 text-sm  border-gray-300 rounded border"
                            placeholder="ancienne mot de passe" />
                        
                    </div>
                    <p class="text-red-500 text-xs italic mb-5">{{ error.oldpass }}</p>
                    <!-- email -->
                    <label for="password2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Nouvelle Mot de passe</label>
                    <div class="relative mb-5 mt-2">
                        <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <rect x="3" y="5" width="18" height="14" rx="3" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                                <line x1="7" y1="15" x2="7.01" y2="15" />
                                <line x1="11" y1="15" x2="13" y2="15" />
                            </svg>
                        </div>
                        <input id="password2"  name="password2" autocomplete="old-password"  v-model="password.new_pass" type="password" required minlength="6"
                            class="text-gray-600 focus:outline-none focus:border focus:border-green-pri font-normal w-full h-10 flex items-center pl-16 text-sm border-gray-300 rounded border"
                            placeholder="nouveaux mot de passe" />
                    </div>
                    <!-- email -->
                    <label for="password3" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Confirmation Mot de passe</label>
                    <div class="relative  mt-2">
                        <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <rect x="3" y="5" width="18" height="14" rx="3" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                                <line x1="7" y1="15" x2="7.01" y2="15" />
                                <line x1="11" y1="15" x2="13" y2="15" />
                            </svg>
                        </div>
                        <input id="password3" name="password3" autocomplete="old-password"    v-model="password.confirm_pass" type="password" required minlength="6"  :class="error.class2"
                            class="text-gray-600 focus:outline-none focus:border focus:border-green-pri font-normal w-full h-10 flex items-center pl-16 text-sm border-gray-300 rounded border"
                            placeholder="nouveaux mot de passe" />
                    </div>
                    <p class="text-red-500 text-xs italic mb-5">{{ error.confirm }}</p>
                    <div class="flex items-center justify-start w-full">
                        <button
                            class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400  bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                            @click="visible = false">Cancel</button>
                        <button type="submit" :disabled="isDis"
                            class="disabled ml-3 transition duration-150 ease-in-out hover:bg-green-600 bg-green-500 rounded text-white px-8 py-2 text-sm"
                            > Enregistrer</button>
                    </div>

                </form>
            </div>
        </Dialog>
        <div class="mb-5 cursor-pointer ml-4 text-[14px] hover:bg-green-pri text-green-pri uppercase hover:text-white border border-green-pri transition duration-200  p-[0.5rem] rounded" @click="open()">
            <h3 ><i class="fa-solid fa-key"></i> Changer le Mot de passe </h3>
        </div>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';

export default {
    name: 'ChangePassword',
    components: {
        Dialog, SpeedDial
    },
    data() {
        return {
            visible: false,
            isDis:false,
            password: {
                old_pass: '',
                new_pass: '',
                confirm_pass: '',
            },
            error: {
                oldpass: '',
                confirm: '',
                class1: '',
                class2: ''
            }
        }
    },
    mounted() {
        
    },

    methods: {
        open() {
            this.visible = true
        },
        ChangeUserInfo() {
            if (this.password.new_pass == this.password.confirm_pass) {
                Axios.post('/changePassword', this.password).then(response => {
                    console.log(response.data)
                    if (response.data.status != 200) {
                        this.error.class1 = 'border-red-500'
                        this.error.oldpass = 'Verifier votre ancien mot de passe'
                    }else{
                        console.log('successfuly...')
                        this.visible = false
                        
                    }
                }).catch(error => {
                    console.log("error dans l'axios: ", error)
                })
            } else {
                this.error.class2 = 'border-red-500'
                this.error.confirm = 'Verifier votre mot de passe de confirmation'
            }
        }
    }
}

</script>
<style>
/* class="p-button p-ocmponent p-button-icon-only p-speeddial-button p-button-rounded p-speeddial-rotate" */
.p-component>button {
    background: #12b659;
    color: #FFF;
    margin-right: 5px;
}
</style>