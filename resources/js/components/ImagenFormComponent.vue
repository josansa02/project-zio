<template>
    <div class="container">
        <form method="POST" @submit.prevent="guardarImagen()" enctype="multipart/form-data">
            <div class="py-4">
                <vue-dropzone ref="myVueDropzone" name="file" id="dropzone" 
                :options="dropzoneOptions"
                @vdropzone-complete="obtenerImagen">
                </vue-dropzone>

                <div class="mt-3">
                    <input v-model="image.titulo" type="text" placeholder="Titulo" class="text-xl p-2 w-full border-b-2 border-green-500">
                    <div class="alert alert-danger mt-1" v-if="errors && errors.title">
                        {{errors.title[0]}}
                    </div>

                    <input v-model="image.pie" type="text" placeholder="Pie de página" class="text-xl p-2 w-full border-b-2 border-green-500">
                    <div class="alert alert-danger mt-1" v-if="errors && errors.footer">
                        {{errors.footer[0]}}
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" value="Subir" class="btn btn-form mt-3 w-25">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

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
                dropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 150,
                    maxFilesize: 30,
                    maxFiles: 1,
                    acceptedFiles: "image/*"
                },
                errors: {}
            }
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        methods: {
            obtenerImagen(response) {
                this.image.imagen = response;
                this.image.nombre = response.name;
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
            }
        },
        computed: {
            imagen() {
                return this.imagenMiniatura;
            }
        }
    }
</script>
