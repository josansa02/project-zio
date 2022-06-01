<template>
    <div>
        <ejs-autocomplete id="autocom" :dataSource='usersData' :placeholder="waterMark" ></ejs-autocomplete>
    </div>
</template>

<script>
    import Vue from "vue";
    import { AutoCompletePlugin } from "@syncfusion/ej2-vue-dropdowns";
    Vue.use(AutoCompletePlugin);

    export default {
        name: 'app',
        data () {
            return {
                waterMark : 'Busca usuarios...',
                usersData: []
            }
        },
        mounted() {
            axios.get('usuarios')
            .then(response => {
                let respuesta = response;
                for(let i = 0 ; i < respuesta.data.length ; i++) {
                    this.usersData.push(respuesta.data[i].name);
                }
            })
        }
    }
</script>
