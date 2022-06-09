<template>
    <div class="container">
        <form method="POST" @submit.prevent="addAdmin()">
            <div class="px-4">

                <div>
                    <div>
                        <label for="name">Nombre: </label> <br>
                        <input id="name" v-model="admin.name" v-on:keyup="comprobar" type="text" class="input-form w-100">
                        <div class="alert alert-danger mt-1" v-if="errors && errors.name">
                            {{errors.name[0]}}
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="email">Email: </label> <br>
                        <input id="email" v-model="admin.email" v-on:keyup="comprobar" type="text" class="input-form w-100">
                        <div class="alert alert-danger mt-1" v-if="errors && errors.email">
                            {{errors.email[0]}}
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="password">Contraseña: </label> <br>
                        <input id="password" v-model="admin.password" v-on:keyup="comprobar" type="password" class="input-form w-100">
                        <div class="alert alert-danger mt-1" v-if="errors && errors.password">
                            {{errors.password[0]}}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" id="bsubir" class="btn btn-success d-flex align-items-center justify-content-center gap-2" disabled>Registrar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    export default {
        data() {
            return {
                admin: {
                    name: "",
                    email: "",
                    password: "",
                },
                errors: {}
            }
        },
        props: ["route"],
        methods: {
            comprobar() {
                var input1 = document.getElementById("name");
                var input2 = document.getElementById("email");
                var input3 = document.getElementById("password");
                var boton = document.getElementById("bsubir");
                boton.disabled = true;
                if (input1.value != "" && input2.value != "" && input3.value != ""){            
                    boton.disabled = false;
                }
            },
            addAdmin() {
                axios.post(this.route, {name: this.admin.name, email: this.admin.email, password: this.admin.password})
                .then(response => {
                    location.reload();
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            }
        }
    }
</script>
