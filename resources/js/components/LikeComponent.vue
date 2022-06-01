<template>
    <div>
        <!-- <div> {{ this.info.data }} </div> -->
        <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> recommend </span>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                info: null
            }
        },
        mounted() {
            axios.get('votos')
            .then(response => (this.info = response))
        }
    }
</script>
