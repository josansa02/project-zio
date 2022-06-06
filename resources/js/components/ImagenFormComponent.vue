<template>
    <div class="container">
        <h2>Formulario de imagen</h2>
        <form method="POST" @submit.prevent="guardarImagen()" enctype="multipart/form-data">
            <div class="py-4">
                <input v-model="image.titulo" type="text" placeholder="Titulo" class="text-xl p-2 w-full border-b-2 border-green-500">
                <div class="alert alert-danger mt-1" v-if="errors && errors.title">
                    Debe completar este campo titulo
                </div>

                <input v-model="image.pie" type="text" placeholder="Pie de página" class="text-xl p-2 w-full border-b-2 border-green-500">
                <div class="alert alert-danger mt-1" v-if="errors && errors.footer">
                    Debe completar el campo pie
                </div>

                <input type="file" @change="obtenerImagen">
                <div class="alert alert-danger mt-1" v-if="errors && errors.name">
                    Debe seleccionar una imagen
                </div>

                <figure v-if="imagen != ''">
                    <img height="200" width="200" :src="imagen">
                </figure>

                <input type="submit" value="Guardar" class="btn btn-primary">
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
            guardarImagen() {
                let formData = new FormData();
                formData.append('title', this.image.titulo);
                formData.append('footer', this.image.pie);
                formData.append('name', this.image.nombre);
                formData.append('files', this.image.imagen);
                axios.post("../imagenes", formData)
                .then(response => {
                    location.reload();
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
                ;
            }
        },
        computed: {
            imagen() {
                return this.imagenMiniatura;
            }
        }
    }
</script>
