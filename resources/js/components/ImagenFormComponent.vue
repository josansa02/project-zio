<template>
    <div class="container">
        <h2>Formulario de imagen</h2>
        <form method="POST" v-on:submit.prevent="guardarImagen()">
            <div class="py-4">
                <input v-model="titulo" type="text" placeholder="Titulo" class="text-xl p-2 w-full border-b-2 border-green-500">
            
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                titulo: ""
            }
        },
        methods: {
            guardarImagen() {
                console.log("Titulo de la imagen: " + this.titulo);
                axios.post("/imagenes", {title: this.titulo, })
                .then(response => { console.log(response) })
                .catch(error => { console.log(error.response) });
                this.titulo = "";
            }
        }
    }
</script>
