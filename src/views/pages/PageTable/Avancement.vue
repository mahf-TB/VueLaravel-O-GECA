<template>
 
 <div class="mt-10 mb-10 md:ml-64">
  <!-- main content page -->
  <div class="mt-2 bg-white p-4 shadow rounded-lg">
    <h2 class="text-gray-500 text-lg font-semibold pb-0">Rechrerche entre deux date</h2>
    <div class="my-1"></div>
    <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-1"></div>
    <table class="w-full table-auto text-sm">
      <thead>
        <tr class="text-sm leading-normal flex justify-between flex-table">
          <th
            class="pt-4 px-4 bg-grey-lightest flex items-center font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
            <div class="flex justify-between items-center  text-xs">
              <button class="text-green-pri flex items-center">
                <i class="fa-solid fa-sliders"></i>
                <div class="ml-2">FILTRES</div>
              </button>
              <button class="text-gray-600 flex items-center ml-4 w-full">avancement des agents dans 6 mois et entre les
                date aujourd'hui</button>
            </div>
          </th>
          <th
            class="py-2 flex justify-between items-center px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">


            <div class=" w-full space-y-2  text-xs ml-4">
              <label class="font-semibold text-gray-600 py-2"></label>
              <Calendar v-model="dates" selectionMode="range" :manualInput="false" showIcon placeholder="Entrer les Date"
                class="h-10 px-4 laceholder-gray-500 border rounded" style="width: 250px; padding:0" />
            </div>
            <div class=" space-y-2 w-full text-xs ml-4">
              <label class="font-semibold text-gray-600 py-2"></label>
              <button @click.prevent="searchDate()"
                class="bg-green-pri w-full hover:bg-white text-white  hover:text-green-pri border border-green-pri transition duration-200 font-semibold py-2 px-4 mb-5 rounded">
                RECHERCHER
              </button>
            </div>
          </th>
        </tr>
      </thead>

    </table>
  </div>
  <!-- Tableau de liste de tout les Encaisemment -->
  <TableAvancement :dataList="dataList" />
  </div>
</template>

<script>
import { jwtDecode } from 'jwt-decode';
import Axios from "@/_service/caller.service";
import TableAvancement from '@/views/DataTable/TableAvancement.vue'

import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Calendar from 'primevue/calendar';
import Menubar from 'primevue/menubar';

export default {
  name: "Avancement",
  components: {
    TableAvancement, Accordion, AccordionTab,
    Calendar,
    Menubar
  },
  data() {
    return {
      dataList: null,
      userID: '',
      dates: null,
      
    }
  },
  mounted() {
    this.getAllRecette()
  },
  methods: {
    async getAllRecette() {
      const token = JSON.parse(localStorage.getItem("token"));
      if (token) {
        const decodedToken = jwtDecode(token)
        this.userID = decodedToken.user_id
      }
      var donnee = new FormData();
      donnee.append('userID', parseInt(this.userID));
      Axios.post('/recette.php?action=list', donnee).then((res) => {
        if (res.data.success) {
          console.log("Success...!", res.data.message);
          this.dataList = res.data.donnees
        } else {
          console.log("Error...!", res.data.message);
        }
      }).catch((err) => {
        console.log("error dans l'axios: ", err)
      })

    },
    searchDate() {
      console.log(this.dates)
    }
  },

};
</script>