<template>
    <div>
        <autocomplete id="autocom"
            :url="ruta"
            anchor="name"
            label="Usuarios"
            :min="1"
            :on-select="getData">
        </autocomplete>
    </div>
</template>

<script>
    import Autocomplete from 'vue2-autocomplete-js';
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css');

    export default {
        components: { Autocomplete },
        props: ["ruta"],
        methods: {
            getData(obj) {
                console.log(obj);
            }
        }
    }
</script>
