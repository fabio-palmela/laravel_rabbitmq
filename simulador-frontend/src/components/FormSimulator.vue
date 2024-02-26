<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
    <v-row>
        <v-col class="mb-5" cols="6">
            
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">Formulário</div>
                    </div>
                </v-card-title>
                <v-text-field
                v-model="valorEmprestimo"
                :counter="10"
                :rules="valorRules"
                prefix="$"
                type="float"
                label="Valor"
                required
                ></v-text-field>
                <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
                ></v-text-field>
                <v-card-actions>
                    <v-btn
                    :disabled="!valid"
                    color="success"
                    @click="simularConsignado"
                    >
                    Simular Consignado
                    </v-btn>

                    <v-btn
                        color="error"
                        @click="clear"
                    >
                    Reset Form
                    </v-btn>
                    <v-btn
                        color="warning"
                        @click="resetValidation"
                    >
                    Reset Validation
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="show = !show">
                        <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                    </v-btn>
                </v-card-actions>
        
                <v-slide-y-transition>
                    <v-card-text v-show="show">
                    I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
                    </v-card-text>
                </v-slide-y-transition>
            </v-card>
        </v-col>
    </v-row>
    
        
        

        
    </v-form>
</template>

<script>

import axios from 'axios';


export default {
    
    data: () => ({
        valid: false,
        firstname: '',
        lastname: '',
        valorRules: [
            v => !!v || 'Name is required',
            v => v.length <= 10 || 'Name must be less than 10 characters'
        ],
        email: '',
        valorEmprestimo: 0.00,
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+/.test(v) || 'E-mail must be valid'
        ]
    }),
    methods: {
        async simularConsignado() {
            try {
                const url = 'http://localhost:8181/api/simular/emprestimo'; // Substitua 'sua-rota' pela rota específica do seu backend
                // const url = 'http://simulador-service:8181/api/simular/emprestimo'; // Substitua 'sua-rota' pela rota específica do seu backend

                const data = {
                    'message':'dell',
                    'valor_credito':this.valorEmprestimo,
                    'cpf_cooperado':'05907569662',
                    'email': this.email
                    // Adicione outros parâmetros conforme necessário
                };
                const headers = {
                    'Content-Type': 'application/json', // Se estiver enviando dados JSON
                    // Adicione outros headers conforme necessário
                };
                const response = await axios.post(url, data, { headers })
                    .then(response => {
                        // Lógica de manipulação da resposta
                        console.log(response.data);
                    })
                    .catch(error => {
                        // Lógica de tratamento de erro
                        console.error('Erro ao fazer a solicitação:', error);
                    });
                this.responseMessage = response.data.message;
            } catch (error) {
                console.error('Erro ao realizar a chamada:', error);
            }
        },
        clear () {
            this.valorEmprestimo = ''
            this.email = ''
            // this.$validator.reset()
        }
    }
}

</script>