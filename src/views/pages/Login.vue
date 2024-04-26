<template>
  <div class="flex items-center justify-center h-screen relative background-radial-gradient overflow-hidden">
    <div id="radius-shape-4" class="absolute rounded-full shadow-lg"></div>
    <div id="radius-shape-1" class="absolute rounded-full shadow-md"></div>
    <div id="radius-shape-2" class="absolute shadow-5-strong shadow"></div>
    <div id="radius-shape-3" class="absolute shadow-5-strong z-0"></div>
    <!-- Login Container -->
    <div class="min-w-[400px] flex-col z-10 border bg-white px-6 py-14 shadow-md rounded-xl">
      <div class="mb-8 flex justify-center">
        <img class="w-60" :src="require('@/assets/Ministère.png')" alt="" />
      </div>
      <form @submit.prevent="login()">
        <div class="flex flex-col text-sm rounded-md">
          <input type="text" class="rounded-[4px] border p-3 hover:outline-none focus:outline-none hover:border-green-400" name="integration[matricule_name]"
            :class="errorClass" required placeholder="Username" v-model="user.nom" />

          <p class="text-red-500 text-xs italic mb-5">{{ errorID }}</p>

          <input class="border rounded-[4px] p-3 hover:outline-none focus:outline-none hover:border-green-400" name="integration[password]"
            :class="errorClass" :type="[toggle ? 'text' : 'password']" placeholder="Password" v-model="user.motdepasse" />
          <p class="text-red-500 text-xs italic mb-5">{{ errorPWD }}</p>

          <div class="flex mb-1 justify-between">
            <div class="mb-3 relative rounded-full w-12 h-6 transition duration-200 ease-linear"
              :class="[toggle ? 'bg-green-400' : 'bg-gray-100']">
              <label for="toggle"
                class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
                :class="[
                  toggle
                    ? 'translate-x-full border-green-400'
                    : 'translate-x-0 border-gray-100',
                ]">
                <input type="checkbox" id="toggle" name="toggle"
                  class="appearance-none w-full h-full active:outline-none focus:outline-none" @click="onToggle()" />
              </label>
            </div>
          </div>
        </div>
        <button
          class="mt-5 w-full border p-2 bg-gradient-to-r from-gray-800 bg-gray-500 text-white rounded-[4px] hover:bg-slate-400 scale-105 duration-300"
          type="submit">
          SE CONNECTER
        </button>
      </form>
      <div class="mt-1 flex justify-between text-center text-[#2f7c89]">
        <RouterLink to="/reset">Mot de passe oublié?</RouterLink>
      </div>
    </div>
  </div>
</template>
  
<script>
import Axios from "@/_service/caller.service";
export default {
  name: "Login",
  components: {},
  data() {
    return {
      user: {
        nom: "",
        motdepasse: "",
      },
      toggle: false,
      errorID: "",
      errorPWD: "",
      errorClass: "",
    };
  },
  methods: {
    async login() {
      if (this.user.nom != "" && this.user.motdepasse != "") {
        var donnee = new FormData();
        donnee.append("username", this.user.nom);
        donnee.append("password", this.user.motdepasse);
      
          Axios.post("/auth/login", donnee)
            .then((response) => {
              if (response.data.success == 200) {
                var token = response.data.token;
                console.log( response.data)
                localStorage.setItem("token", JSON.stringify(token));
                this.$router.push("/");
              } else {
                this.errorID = "Verifiez votre matricule ou adresse email";
                this.errorPWD = "Verifiez votre mot de passe";
                this.errorClass = "border-red-500";
              }
            })
            .catch((error) => {
              console.log("error dans l'axios: ", error);
            });
        
      } else {
        this.errorID = "Entrer votre matricule ou adresse email";
        this.errorPWD = "Entrer votre mot de passe";
        this.errorClass = "border-red-500";
      }
    },
    async error() {
    },
    onToggle() {
      this.toggle = !this.toggle;
    },
  },
};
</script>
<style>
.background-radial-gradient {
  background-color: hsl(176, 45%, 14%);
  background-image: radial-gradient(650px circle at 0% 0%,
      hsl(164, 41%, 35%) 15%,
      hsl(164, 41%, 30%) 35%,
      hsl(164, 41%, 20%) 75%,
      hsl(164, 41%, 19%) 80%,
      transparent 100%),
    radial-gradient(1250px circle at 100% 100%,
      hsl(164, 41%, 45%) 15%,
      hsl(164, 41%, 30%) 35%,
      hsl(164, 41%, 20%) 75%,
      hsl(165, 56%, 15%) 80%,
      transparent 100%);
}

#radius-shape-1 {
  height: 220px;
  width: 220px;
  top: -60px;
  left: -100px;
  background: radial-gradient(#6b5b00, #dfa621);
  overflow: hidden;
}

#radius-shape-4 {
  height: 220px;
  width: 220px;
  top: 100px;
  left: 500px;
  background: radial-gradient(#6b5b00, #dfa621);
  overflow: hidden;
}

#radius-shape-2 {
  border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
  bottom: 0px;
  right: -110px;
  width: 300px;
  height: 300px;
  background: radial-gradient(#6b5b00, #dfa621);
  overflow: hidden;
}

#radius-shape-3 {
  border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
  z-index: 0;
  right: 450px;
  width: 300px;
  height: 300px;
  bottom: 100px;
  background: radial-gradient(#6b5b00, #dfa621);
  overflow: hidden;
}

</style>