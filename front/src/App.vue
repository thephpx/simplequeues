<template>
  <v-app>
    <v-toolbar app>
      <v-toolbar-title class="headline text-uppercase">
        <span>Simple</span>
        <span class="font-weight-light">Queues</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>

    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
import PrintToken from './components/PrintToken'

export default {
  name: 'App',
  components: {
    PrintToken
  },
  data () {
    return {
      //
    }
  }
}
</script>
