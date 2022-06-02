<template>
    <div>
        <form method="POST" @submit.prevent="recogerId()">
            <div class="py-4">
                <button type="submit" class="btn-like">
                    <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> recommend </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                info: null
            }
        },
        props: ["img_id"],
        methods: {
            recogerId() {
                console.log("Id de la imagen clickada: " + this.img_id);
            }
        },
        mounted() {
            axios.get('votos')
            .then(response => (this.info = response))
        }
    }
</script>
