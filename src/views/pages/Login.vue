<template>
  <div class="flex items-center justify-center h-screen" style="background: #edf2f7;">
    <!-- Login Container -->
    <div class="min-w-fit flex-col border bg-white px-6 py-14 shadow-md rounded-xl">
      <div class="mb-8 flex justify-center">
        <img class="w-60" :src="require('@/assets/Ministère.png')" alt="" />
      </div>
      <div class="flex flex-col text-sm rounded-md">
        <input type="text" class="rounded-[4px] border p-3 hover:outline-none focus:outline-none hover:border-green-400" :class="errorClass"
          required placeholder="Email or Matricule" v-model="user.nom" />
        <p class="text-red-500 text-xs italic mb-5">{{ errorID }}</p>
        <input class=" border rounded-[4px] p-3 hover:outline-none focus:outline-none hover:border-green-400" :class="errorClass"
          :type="[toggle ? 'text' : 'password']" placeholder="Password" v-model="user.motdepasse" />
        <p class="text-red-500 text-xs italic mb-5">{{ errorPWD}}</p>
        <div class="flex mb-1 justify-between">
          <div class="mb-3 relative rounded-full w-12 h-6 transition duration-200 ease-linear"
            :class="[toggle ? 'bg-green-400' : 'bg-gray-100']">
            <label for="toggle"
              class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
              :class="[toggle ? 'translate-x-full border-green-400' : 'translate-x-0 border-gray-100']">
              <input type="checkbox" id="toggle" name="toggle"
                class="appearance-none w-full h-full active:outline-none focus:outline-none" @click="onToggle()" />
            </label>
          </div>
        </div>
      </div>
      <button
        class="mt-5 w-full border p-2 bg-gradient-to-r from-gray-800 bg-gray-500 text-white rounded-[4px] hover:bg-slate-400 scale-105 duration-300"
        type="submit" @click.prevent="login()">SE CONNECTER</button>
      <div class="mt-5 flex justify-between text-center text-gray-600">
        <RouterLink to="/reset">Mot de passe oublié?</RouterLink>
      </div>
      <div class="mt-5 flex text-center text-sm text-gray-400">
        <p>
          This site is protected by reCAPTCHA and the Google
        </p>
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
        nom: '',
        motdepasse: ''
      },
      toggle: false,
      errorID : '',
      errorPWD : '',
      errorClass:''
    }
  },
  methods: {
    async login() {

      if (this.user.nom != '' && this.user.motdepasse != '') {

        var donnee = new FormData();
        donnee.append('matricule-mail', this.user.nom);
        donnee.append('password', this.user.motdepasse);

        Axios.post('/auth/login', donnee).then((response) => {
          if (response.data.success == 200) {
            var token = response.data.token
            localStorage.setItem("token", JSON.stringify(token))
            this.$router.push("/");
          } else {
            this.errorID = 'Verifiez votre matricule ou email'
            this.errorPWD = 'Verifiez votre mot de passe'
            this.errorClass='border-red-500'
          }

        }).catch((error) => {
          console.log("error dans l'axios: ", error)
        })
      } else {
        this.errorID = 'Entrer votre matricule ou email'
        this.errorPWD = 'Entrer votre mot de passe'
        this.errorClass='border-red-500'
      }

    },
    error() {

    },
    onToggle() {
      this.toggle = !this.toggle
    },
  }

}
</script>
<style></style>