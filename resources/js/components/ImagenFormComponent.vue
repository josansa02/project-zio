<template>
    <div class="container">
        <form method="POST" @submit.prevent="guardarImagen()" enctype="multipart/form-data">
            <div class="p-4">
                <vue-dropzone ref="myVueDropzone" name="file" id="dropzone" 
                :options="dropzoneOptions"
                @vdropzone-success="obtenerImagen">
                </vue-dropzone>

                <div class="mt-3">
                    <div>
                        <label for="titulo">Título de la imagen: </label> <br>
                        <input id="titulo" v-model="image.titulo" v-on:keyup="comprobar" type="text" class="input-form w-100">
                        <div class="alert alert-danger mt-1" v-if="errors && errors.title">
                            {{errors.title[0]}}
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="pie">Pie de foto: </label> <br>
                        <input id="pie" v-model="image.pie" v-on:keyup="comprobar" type="text" class="input-form w-100">
                        <div class="alert alert-danger mt-1" v-if="errors && errors.footer">
                            {{errors.footer[0]}}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <input type="submit" id="bsubir" value="Subir" class="btn btn-form w-25" disabled>
                </div>
            </div>
        </form>
    </div>
</template>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        data() {
            return {
                imagenSubida: false,
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
                    acceptedFiles: "image/*",
                    dictDefaultMessage: "Arrastre y suelte su imagen o haga click aquí...",
                    dictInvalidFileType: "No puede subir archivos de este tipo",
                    init: function() {
                        this.on("maxfilesexceeded", function(file) {
                                this.removeAllFiles();
                                this.addFile(file);
                        });
                    }  
                },
                errors: {}
            }
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        methods: {
            comprobar() {
                var input1 = document.getElementById("titulo");
                var input2 = document.getElementById("pie");
                var boton = document.getElementById("bsubir");
                boton.disabled = true;
                if (input1.value != "" && input2.value != "" && this.imagenSubida){            
                    boton.disabled = false;
                }
            },
            obtenerImagen(response) {
                this.image.imagen = response;
                this.image.nombre = response.name;
                this.imagenSubida = true;
                this.comprobar();
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
                        Swal.fire(
                        'Error',
                        'No puede subir archivos que no tengan formato de imagen',
                        'error'
                        );
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
