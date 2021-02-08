<template>
    <div>
        <div class="list-container">
            <h3>Adicionar</h3>
            <hr>
            <form>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input v-model="categoria.nome" type="text" class="form-control" id="nome">
                </div>
                <button @click="cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>

        <hr>

        <div class="list-container">
            <h3>Deletar</h3>
            <hr>
            <div>
                <div class="input-group mb-3">
                    <input v-model="termos" type="text" class="form-control" placeholder="Filtrar por nome" aria-label="Filtrar por nome" aria-describedby="button-addon2">
                    <button @click="buscar" class="btn btn-outline-success" type="button" id="button-addon2">Buscar</button>
                </div>

                <!-- Lista de categorias -->
                <hr>
                <categories-itens-list :items="items" :remover="remover" v-on:recarregarLista="buscar"/>
            </div>
        </div>
        
    </div>
</template>

// Javascript ------------------------------------------------
<script>

import categoriesItensList from './categoriesItensList';

export default {
    components:{
        categoriesItensList
    },
    data: function(){
        return {
            categoria: {
                "nome": "",
            },
            termos: "",
            items: [],
            remover: 1
        }
    },
    methods:{
        cadastrar: function(){
            axios.post('/categorias/store', {
                categoria: this.categoria
            }).then(res => {
                this.categoria.nome = '';

                // Se já estiver listando para exclusão, então recarega a lista.
                if(this.items.length > 0){
                    this.buscar();
                }
            })
            .catch(error => {
                console.log(error);
            });
        },
        buscar: function(){
            axios.get('/categorias/buscar', {
                params: {
                    termos: this.termos
                }
            }).then(res => {
                this.items = res.data;
            });
        },
    }
}
</script>

// Style -----------------------------------------------------
<style scoped>
.list-container{
    border: solid 1px #c6c6c6;
    padding: 20px;
}
</style>