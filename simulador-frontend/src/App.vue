<template>
  <v-app>
    <!-- <v-main>
      <SimulacaoEmprestimo/>
    </v-main> -->
    <v-content>
      <v-container>
        <router-link to="/">Simular</router-link>
        <router-link to="/emprestimo">Listar Simulações</router-link>
        <router-view></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
// import SimulacaoEmprestimo from './components/SimulacaoEmprestimo.vue'

export default {
  name: 'App',

  components: {
    // HelloWorld,
    // SimulacaoEmprestimo,
  },

  data: () => ({
    //
  }),
}
</script>
