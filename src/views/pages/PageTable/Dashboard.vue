<template>
  <div class="mt-10 mb-10 md:ml-64">
    <div class=" grid grid-cols  lg:grid-cols-2 p-4 gap-4">
    <!-- Tableau de bord graphe -->
    <!-- <div class="mt-8 flex justify-between flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0"> -->
      <!-- chart 2 en user -->
      <div class="flex-1 bg-white p-4 shadow rounded-lg ">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Agents ayant de</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <div class="chart-container" style="position: relative; height:150px; width:100%">
          <canvas id="usersChart"></canvas>
        </div>
      </div>
      <!-- chart 2 en user -->
      <div class="flex-1 bg-white p-4 shadow rounded-lg">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Usuarios</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <div class="chart-container" style="position: relative; height:150px; width:100%">
          <canvas id="usersChart"></canvas>
        </div>
      </div>
    </div>
    <!-- main content page -->
    <div class="w-full p-4">
      <CardStatVue />
    </div>

  </div>
</template>

<script>
import CardStatVue from '@/components/CardStat.vue'

export default {
  name: 'HomePage',
  components: {
    CardStatVue
  },
  data() {
    return {

    }
  },
  mounted() {


  },


}
</script>