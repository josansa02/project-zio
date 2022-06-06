<template>
    <div>        
        <autocomplete id="autocom"
            url="usuarios"
            anchor="name"
            label="Usuarios"
            :on-select="getData">
        </autocomplete>
    </div>
</template>

<script>
    import Autocomplete from 'vue2-autocomplete-js';
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css');

    export default {
        components: { Autocomplete },
        methods: {
            getData(obj) {
                console.log(obj);
            }
        }
    }
</script>
