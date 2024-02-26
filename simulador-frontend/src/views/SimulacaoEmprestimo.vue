<template>
    <v-container grid-list-md text-xs-center fluid>
        <v-row class="text-center">
            <v-col class="mb-8" cols="12">
                
                <FormSimulator></FormSimulator>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import FormSimulator from '../components/FormSimulator.vue'

export default {
components: { 
    FormSimulator 
},

}

</script>