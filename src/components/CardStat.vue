<template>
  <div class=" grid grid-cols  sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
    <div v-for="(data, index) in dataCard" v-bind:key="index">
      <div  :class="data.class"
        class="shadow-lg rounded-md flex flex-wrap items-center h-[150px] justify-between p-3 border-b-4  text-white font-medium group">
        <div  class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="data.icon"
            class="stroke-current  transform transition-transform duration-500 ease-in-out">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
          </svg>
        </div>
        <div class="text-right">
          <p class="text-2xl">{{ data.value }}</p>
        </div>
        <p class="mt-2">{{ data.name }}</p>
      </div>
    </div> 
    <div v-for="(data,index) in 8" v-bind:key="index">
      <SkeletCard v-if="isLoad"/>
    </div>
  </div>
</template>

<script>
import Axios from '@/_service/caller.service';
import SkeletCard from './Skeleton/SkeletCard.vue';
export default {
  name: 'cardStat',
  components: {
    SkeletCard
  },
  data() {
    return {
      isLoad:true,
      dataCard: [

      ]

    }
  },
  mounted() {
    this.getCount();
  },
  methods: {
    async getCount() {
      this.isLoad = true
      try {
        const response = await Axios.get('/countAgents')
        var data = response.data;
        this.dataCard = [
          { value: data.Avenant6mois , name: 'Agents qui doit faire leur avancement dans 6 mois', 'class': 'bg-gray-400  border-gray-600', icon: 'text-gray-400' },
          { value: data.AvenantTard , name: 'Agents qui doivent faire leur avancement', 'class': 'bg-gray-400  border-gray-600', 'icon': 'text-gray-400' },
          { value: data.contrat6mois , name: 'Agent qui doivent renouveller son contrat dans 6 mois', 'class': 'bg-[#427D9D]  border-[#176B87]', icon: 'text-[#427D9D]' },
          { value: data.contratTard, name: 'Agent qui sont expirer son contrat', 'class': 'bg-[#427D9D] border-[#176B87]', icon: 'text-[#427D9D]' },
          { value: data.Retrait1ans, name: 'Agents qui vont à la Retraite dans 12 mois', 'class': 'bg-yellow-600   border-yellow-400', icon: 'text-yellow-600' },
          { value: data.RetraitTard, name: 'Agents qui sont doivent aller à la Retraite', 'class': 'bg-yellow-600   border-yellow-400', icon: 'text-yellow-600' },
          { value: null, name: 'Agents qui ont des Categorie HEE', 'class': 'bg-blue-400   border-blue-600', icon: 'text-blue-400' },
          { value: null, name: 'Agents qui ont des Categorie HEE', 'class': 'bg-blue-400   border-blue-600', icon: 'text-blue-400' },
        ]
        console.log(data)
      } catch (error) {
        console.log("error dans l'axios: ", error)
      } finally {
        this.isLoad = false
      }

    },
  }
}
</script>