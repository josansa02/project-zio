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
                paco: null
            }
        },
        props: ["img_id"],
        methods: {
            recogerId() {
                axios.post("votos", {img_id: this.img_id})
                .then(response => { 
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
