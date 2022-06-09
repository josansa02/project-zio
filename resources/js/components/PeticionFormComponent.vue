<template>
    <div class="container mt-5">
        <div class="row justify-content-center" v-if="mostrar">
            <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                <h5 class="d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-danger fs-1"> report </span> 
                    Su cuenta ha sido suspendida, rellene el siguiente formulario de petición de rehabilitación de cuenta si lo desea
                </h5>
                <h2>Formulario de petición de rehabilitación de cuenta</h2>
                <div class="w-75">
                    <form method="POST" v-on:submit.prevent="enviarPeticion()">
                        <div class="py-4">
                            <textarea v-model="unban_reason" type="text" rows="5" placeholder="Escriba aquí su petición" class="form-control" maxlength="140"></textarea>
                            
                            <div class="alert alert-danger mt-1" v-if="errors && errors.unban_reason">
                                Debe completar este campo
                            </div>

                            <input type="submit" value="Enviar peticion" class="mt-2 btn btn-form swal-peticion-enviada">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" v-if="!mostrar">
            <div class="d-flex justify-content-center gap-2">
                <h5 class="d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-danger fs-1"> report </span> 
                    Su mensaje ha sido enviado, espere a que los administradores revisen la petición
                </h5>
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
                mostrar: true,
                errors: {}
            }
        },
        props: ["user_id"],
        methods: {
            enviarPeticion() {
                axios.post("peticiones", {unban_reason: this.unban_reason})
                .then(response => { 
                    this.mostrar = false;
                    Swal.fire(
                        'Petición enviada',
                        'Has enviado tu petición de rehabilitación de cuenta, ahora debes esperar a que los administradores la revisen y tomen una decisión',
                        'success'
                    );
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error.response) 
                });
                this.unban_reason = "";
            }
        },
        mounted () {
            axios.get("getpeticiones")
            .then(response => {
                this.mostrar = true;
                for (let i = 0; i < response.data.length; i++) {
                    if(response.data[i].user_id == this.user_id) {
                        this.mostrar = false;
                    }
                }
            })
        }
    }
</script>

