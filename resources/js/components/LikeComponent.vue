<template>
    <div>
        <form method="POST" @submit.prevent="recogerId()" v-if="this.mostrar">
            <div class="py-4">
                <button type="submit" class="btn-like">
                    <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> recommend </span>
                </button>
            </div>
        </form>

        <form method="POST" @submit.prevent="recogerId()" v-if="!this.mostrar">
            <div class="py-4">
                <button type="submit" class="btn-like">
                    <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> check_circle </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                mostrar: true
            }
        },
        props: ["img_id", "user_id", "ruta_votos", "ruta_getvotos"],
        methods: {
            recogerId() {
                axios.post(this.ruta_votos, {img_id: this.img_id})
                .then(response => { 
                    if (this.mostrar == true) {
                        this.mostrar = false;
                    }
                    else {
                        this.mostrar = true;
                    }
                })
                .catch(error => {
                    console.log(error.response) 
                });
            },
            comprobarTipo() {
                axios.get(this.ruta_getvotos)
                .then(response => {
                    for (let i = 0; i < response.data.length; i++) {
                        if(response.data[i].img_id == this.img_id && response.data[i].user_id == this.user_id) {
                            this.mostrar = false;
                        }
                    }
                })
            }
        },
        mounted () {
            this.comprobarTipo();
        }
    }
</script>
