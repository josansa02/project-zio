<template>
    <div>
        <form method="POST" @submit.prevent="recogerId()" v-if="this.mostrar">
            <div class="py-4">
                <button type="submit" class="btn-like">
                    <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> recommend </span>
                </button>
            </div>
        </form>
        <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple cursor-default" v-if="!this.mostrar"> check_circle </span>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                mostrar: true
            }
        },
        props: ["img_id"],
        methods: {
            recogerId() {
                axios.post("votos", {img_id: this.img_id})
                .then(response => { 
                    this.mostrar = false;
                    // Swal.fire(
                    //     'Petición enviada',
                    //     'Has enviado tu petición de rehabilitación de cuenta, ahora debes esperar a que los administradores la revisen y tomen una decisión',
                    //     'success'
                    // );
                })
                .catch(error => {
                    console.log(error.response) 
                });

            }
        }
    }
</script>
