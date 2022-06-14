<template>
    <div class="container">
        <form method="POST" @submit.prevent="actualizarImagen()" enctype="multipart/form-data">
            <div class="p-4">
                <vue-dropzone ref="myVueDropzone" name="file" id="dropzone" 
                :options="dropzoneOptions"
                @vdropzone-success="obtenerImagen">
                </vue-dropzone>

                <div class="d-flex justify-content-center mt-3">
                    <input type="submit" id="bsubir" value="Actualizar" class="btn btn-form boton-subir" disabled>
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
        props: ["user_id"],
        methods: {
            comprobar() {
                var boton = document.getElementById("bsubir");
                boton.disabled = true;
                if (this.imagenSubida){            
                    boton.disabled = false;
                }
            },
            obtenerImagen(response) {
                this.image.imagen = response;
                this.image.nombre = response.name;
                this.imagenSubida = true;
                this.comprobar();
            },
            actualizarImagen() {
                var boton = document.getElementById("bsubir");
                boton.disabled = true;

                let formData = new FormData();
                formData.append('name', this.image.nombre);
                formData.append('files', this.image.imagen);
                axios.post("../../usuarios/edit/profileimg/" + this.user_id, formData)
                .then(response => {
                    location.reload();
                }).catch(error => {
                    boton.disabled = false;
                    
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
