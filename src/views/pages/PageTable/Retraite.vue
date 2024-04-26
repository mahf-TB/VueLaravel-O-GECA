<template>
  <div class="mt-10 mb-10 md:ml-56">
    <!-- main content page -->
    <div class="mt-2 bg-white p-4 shadow rounded-lg">
      <h2 class="text-gray-500 text-lg font-semibold pb-0">Filtres et rechrerche entre deux date</h2>
      <div class="my-1"></div>
      <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-1"></div>
      <table class="w-full table-auto text-sm">
        <thead>
          <tr class="text-sm leading-normal flex justify-between flex-table">
            <th
              class="pt-4 px-4 bg-grey-lightest flex items-center  font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
              <div class="flex justify-between items-center  text-xs">
                <Menubar :model="items" class="text-green-pri  h-[40px] text-sm" />
                <button class="text-gray-600 text-sm flex items-center ml-4 w-full">{{ titre }}</button>
              </div>
            </th>
            <th
              class="py-2 flex justify-between items-center px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">

              <div class=" w-full space-y-2  text-xs ml-4">
                <label class="font-semibold text-gray-600 py-2"></label>
                <Calendar v-model="dates" selectionMode="range" :manualInput="false" showIcon dateFormat="dd/mm/yy"
                  placeholder="Entrer les Date" class="h-10 px-4 laceholder-gray-500 border rounded"
                  style="width: 250px; padding:1px" />
              </div>
              <div class=" space-y-2 w-full text-xs ml-4">
                <label class="font-semibold text-gray-600 py-2"></label>
                <button @click="searchDate()"
                  class="bg-green-pri w-full hover:bg-white text-white  hover:text-green-pri border border-green-pri transition duration-200 font-semibold py-2 px-4 mb-5 rounded">
                  RECHERCHER
                </button>
              </div>
            </th>
          </tr>
        </thead>
      </table>
    </div>
    <TableRetraite v-if="!isLoad" :dataList="dataList" />

    <SkeletRetraiteVue v-if="isLoad" />
  </div>
</template>

<script>

import Axios from "@/_service/caller.service";
import TableRetraite from '@/views/DataTable/TableRetraite.vue'
import SkeletRetraiteVue from '@/components/Skeleton/SkeletRetraite.vue';
import Calendar from 'primevue/calendar';
import Menubar from "primevue/menubar";

export default {
  name: 'Contractuel',
  components: {
    TableRetraite, Calendar, SkeletRetraiteVue,
    Menubar
  },
  data() {
    return {
      dataList: null,
      titre: 'Liste des agents avec sa date de retraite',
      dates: null,
      isLoad: true,
      items: [
        {
          label: 'FILTRES',
          icon: 'fa-solid fa-sliders',
          items: [
            {
              label: ' Agents retraite bientot',
              icon: 'pi pi-bolt',
              command: () => {
                this.getAllRetraite1ans()
              }
            },
            {
              label: 'agents retraite entard ',
              icon: 'pi pi-bolt',
              command: () => {
                this.getAllRetraiteTard()
              }
            },
          ]
        }
      ]

    }
  },
  mounted() {

    this.getAllRetraite()
  },
  methods: {
    async getAllRetraite() {
      this.isLoad = true
      try {
        const response = await Axios.get('/indexRetraite?retraite=true')
        this.dataList = response.data.DataAgents;
       
      } catch (error) {
        console.log("error dans l'axios: ", error)
      } finally {
        this.isLoad = false
      }


    },
    async getAllRetraite1ans() {
      this.isLoad = true
      try {
        const response = await Axios.get('/indexRetraite?retraite1ans=true')
        this.dataList = response.data.DataAgents;
        this.titre = 'Liste des agents qui seront pris sa retraite dans 1 an'
      } catch (error) {
        console.log("error dans l'axios: ", error)
      } finally {
        this.isLoad = false
      }

    },
    async getAllRetraiteTard() {
      this.isLoad = true
      try {
        const response = await Axios.get('/indexRetraite?retraiteTard=true')
        this.dataList = response.data.DataAgents;
        this.titre = 'Liste des agents qui ont plus de 60 ans et tard sa retraite'
      } catch (error) {
        console.log("error dans l'axios: ", error)
      } finally {
        this.isLoad = false
      }

    },
    async searchDate() {` `
      if (this.dates == null) {
        console.log('aucun date selectionner')
      } else {
        var debut = this.dates[0] 
        var fin = this.dates[1]
        if (debut != '' && fin != '') {
          var date_debut = this.formatDate(debut)
          var date_fin = this.formatDate(fin)
          
          var donnee = new FormData();
          donnee.append('datedebut', date_debut);
          donnee.append('datefin', date_fin);
          this.isLoad = true
          try {
            const response = await Axios.post('/retraiteDeuxDate', donnee)
            console.log(response.data.DataAgents)
            this.dataList = response.data.DataAgents;
          } catch (error) {
            console.log("error dans l'axios: ", error)
          } finally {
            this.isLoad = false
          }
        }

      }
    },
    formatDate(date) {
      return date.toISOString().slice(0, 19);
    }
  },

}
</script>