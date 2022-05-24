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
                        <input type="submit" value="Enviar peticion" class="mt-2 btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                unban_reason: "",
            }
        },
        methods: {
            enviarPeticion() {
                axios.post("peticiones", {unban_reason: this.unban_reason})
                .then(response => { 
                    alert("Mensaje enviado");
                })
                .catch(error => {
                    console.log(error.response) 
                });
                this.unban_reason = "";
            }
        }
    }
</script>
