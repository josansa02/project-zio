<template>
    <div class="container">
        <h2>Formulario de imagen</h2>
        <form method="POST" @submit.prevent="guardarImagen()" enctype="multipart/form-data">
            <div class="py-4">
                <input v-model="image.titulo" type="text" placeholder="Titulo" class="text-xl p-2 w-full border-b-2 border-green-500">
                <input v-model="image.pie" type="text" placeholder="Pie de página" class="text-xl p-2 w-full border-b-2 border-green-500">
                <input type="file" @change="obtenerImagen">

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
                    nombre: ""
                }
            }
        },
        methods: {
            obtenerImagen(e) {
                let file = e.target.files[0];
                console.log(file);
                this.image.nombre = file;
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

                axios.post("imagenes", formData)
                .then(response => {
                    console.log(response.data);
                });

                // console.log("Titulo de la imagen: " + this.titulo);
                // console.log("Pie de la imagen: " + this.pie);
                // axios.post("imagenes", {name: this.nombre, title: this.titulo, footer: this.pie, user_id: 1})
                // .then(response => { 
                //     console.log(response.data);
                //     alert("Ha insertado una imagen correctamente");
                // })
                // .catch(error => { console.log(error.response) });
                // this.titulo = "";
                // this.pie = "";
            }
        },
        computed: {
            imagen() {
                return this.imagenMiniatura;
            }
        }
    }

    // export default {
    //     data() {
    //         return {
    //             titulo: "",
    //             pie: "",
    //             nombre: "pepe"
    //         }
    //     },
    //     methods: {
    //         guardarImagen() {
    //             console.log("Titulo de la imagen: " + this.titulo);
    //             console.log("Pie de la imagen: " + this.pie);
    //             axios.post("imagenes", {name: this.nombre, title: this.titulo, footer: this.pie, user_id: 1})
    //             .then(response => { 
    //                 console.log(response.data);
    //                 alert("Ha insertado una imagen correctamente");
    //             })
    //             .catch(error => { console.log(error.response) });
    //             this.titulo = "";
    //             this.pie = "";
    //         }
    //     }
    // }
</script>
