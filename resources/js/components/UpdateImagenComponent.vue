<template>
    <div>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar imagen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" @submit.prevent="actualizarImagen()" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="modal_input">
                    <label for="file" class="subir_boton"> Haz clic aquí para seleccionar una imagen </label>
                    <input type="file" @change="obtenerImagen">
                    <div class="alert alert-danger mt-1" v-if="errors && errors.name">
                        Debe seleccionar una imagen
                    </div>            
                </div>
                <figure v-if="imagen != ''">
                    <img height="200" width="200" :src="imagen">
                </figure>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Actualizar" class="btn btn-primary">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                imagenMiniatura: "",
                image: {
                    titulo: "",
                    pie: "",
                    nombre: "",
                    imagen: ""
                },
                errors: {}
            }
        },
        props: ["user_id"],
        methods: {
            obtenerImagen(e) {
                let file = e.target.files[0];
                this.image.imagen = file;
                console.log(file);
                this.image.nombre = file.name;
                this.cargarImagen(file);
            },
            cargarImagen(file) {
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.imagenMiniatura = e.target.result;
                }

                reader.readAsDataURL(file);
            },
            actualizarImagen() {
                let formData = new FormData();
                axios.put("../../usuarios/edit/profileimg/" + this.user_id, {name: this.image.nombre, files: this.image.imagen})
                .then(response => {
                    console.log(response);
                    // location.reload();

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            }
        },
        computed: {
            imagen() {
                return this.imagenMiniatura;
            }
        }
    }
</script>
