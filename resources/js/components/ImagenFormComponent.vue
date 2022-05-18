<template>
    <div class="container">
        <h2>Formulario de imagen</h2>
        <form method="POST" v-on:submit.prevent="guardarImagen()" enctype="multipart/form-data">
            <div class="py-4">
                <input v-model="titulo" type="text" placeholder="Titulo" class="text-xl p-2 w-full border-b-2 border-green-500">
                <input v-model="pie" type="text" placeholder="Pie de página" class="text-xl p-2 w-full border-b-2 border-green-500">
                <input type="file" id="dmsFile" name="dmsFile" @change="getFile($event)"/>

                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                titulo: "",
                pie: "",
                nombre: "pepe"
            }
        },
        methods: {
            guardarImagen() {
                console.log("Titulo de la imagen: " + this.titulo);
                console.log("Pie de la imagen: " + this.pie);
                axios.post("imagenes", {name: this.nombre, title: this.titulo, footer: this.pie, user_id: 1})
                .then(response => { 
                    console.log(response.data);
                    alert("Ha insertado una imagen correctamente");
                })
                .catch(error => { console.log(error.response) });
                this.titulo = "";
                this.pie = "";
            }
        }
    }
</script>
