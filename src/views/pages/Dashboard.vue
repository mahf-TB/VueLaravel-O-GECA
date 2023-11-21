<template>
  <!-- Tableau de bord graphe -->
  <div class="mt-8 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <!-- chart 2 en user -->
    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
      <h2 class="text-gray-500 text-lg font-semibold pb-1">Usuarios</h2>
      <div class="my-1"></div> 
      <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
      <div class="chart-container" style="position: relative; height:150px; width:100%">
        <canvas id="usersChart"></canvas>
      </div>
    </div>

<!-- chart 2 en user -->
    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
      <h2 class="text-gray-500 text-lg font-semibold pb-1">Comercios</h2>
      <div class="my-1"></div> 
      <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
      <div class="chart-container" style="position: relative; height:150px; width:100%">    
        <canvas id="commercesChart"></canvas>
      </div>
    </div>
  </div>
  <!-- main content page -->
  <div class="w-full p-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quam odit officiis
    magni doloribus ipsa dolore, dolores nihil accusantium labore, incidunt autem iure quae vitae voluptate,
    esse asperiores aliquam repellat. Harum aliquid non officiis porro at cumque eaque inventore iure. Modi sunt
    optio mollitia repellat sed ab quibusdam quos harum!</div>
</template>

<script>

export default {
  name: 'HomePage',
  data() {
    return {

    }
  },
  mounted() {


  },


}
</script>