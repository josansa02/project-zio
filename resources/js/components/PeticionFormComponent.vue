<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 row gap-2">
                <h5 class="d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-danger fs-1"> report </span> 
                    Su cuenta ha sido suspendida, por favor rellene el siguiente formulario de petición de rehabilitación de cuenta si lo desea
                </h5>
                <h2>Formulario de petición de rehabilitación de cuenta</h2>
                <form method="POST" v-on:submit.prevent="enviarPeticion()">
                    <div class="py-4">
                        <textarea v-model="unban_reason" type="text" rows="5" placeholder="Escriba aquí su petición" class="form-control"></textarea>
                        
                        <div class="alert alert-danger mt-1" v-if="errors && errors.unban_reason">
                            Debe completar este campo
                        </div>

                        <input type="submit" value="Enviar peticion" class="mt-2 btn btn-primary swal-peticion-enviada">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    export default {
        data() {
            return {
                unban_reason: "",
                errors: {}
            }
        },
        methods: {
            enviarPeticion() {
                axios.post("peticiones", {unban_reason: this.unban_reason})
                .then(response => { 
                    Swal.fire(
                        'Petición enviada',
                        'Has enviado tu petición de rehabilitación de cuenta, ahora debes esperar a que los administradores la revisen y tomen una decisión',
                        'success'
                    );
                    // console.log(response);
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error.response) 
                });
                this.unban_reason = "";
            }
        }
    }
</script>

