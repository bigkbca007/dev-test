<template>
    <div>
        <!-- Filtros -->
        <div class="list-conatiner">

            <div class="input-group mb-3">
                <input v-model="filtro.titulo" type="text" class="form-control" placeholder="Recipient's username" aria-label="Filtrar por titulo" aria-describedby="button-addon2">
                <button @click="filtrar(1)" class="btn btn-outline-success" type="button" id="button-addon2">Filtrar</button>
            </div>

            <div class="field has-addons">
                <div class="control">
                    <div class="select">
                        <v-select
                            :options="options_categorias"
                            :reduce="nome => nome.id"
                            label="nome"
                            v-model="filtro.categoria"
                        />

                    </div>
                </div>
                <div class="input-group mb-3">
                    <button @click="filtrar(2)" class="btn btn-outline-success">
                        Filtrar
                    </button>
                </div>
            </div>

            <div class="input-group mb-3">
                <input v-model="filtro.autor" type="text" class="form-control" placeholder="Filtrar por autor" aria-label="Filtrar por titulo" aria-describedby="button-addon2">
                <button @click="filtrar(3)" class="btn btn-outline-success" type="button" id="button-addon2">Filtrar</button>
            </div>

        </div>

        <hr>
        
        <!-- Lista de categorias -->
        <div class="list-conatiner">
            <post-itens-list :items="items" :remover="remover" />
        </div>
            
    </div>
</template>

// Javascript ------------------------------------------------
<script>

import postItensList from './postsItensList';

export default {
    components: {
        postItensList
    },
    data: function(){
        return {
            items: [],
            remover: 0,
            filtro: {
                titulo: '',
                categoria: '',
                autor: ''
            },
            options_categorias: [],
            categoria_id: 0
        }
    },
    methods: {
        getPosts: function(){
            axios.get('/posts/buscar', {
                params: {
                    termos: ''
                }
            }).then(res => {
                this.items = res.data;
            });
        },
        filtrar: function(tipo){
            axios.get('/posts/buscar/', {
                params: {
                    tipo: tipo,
                    filtro: this.filtro
                }
            })
            .then(res => {
                if(200 == res.status){
                    this.items = res.data;
                }
            })
            .catch(error => {
                console.log(error);
            });
        },

    },
    created(){
        this.getPosts();

        axios.get('/categorias/getOptions')
        .then(res => {
            this.options_categorias = res.data;
        }).
        catch(error => {
            console.error('Hove um erro ao tentar buscar as categorias.');
            console.error(error);
        });
    }
}
</script>

// Style -----------------------------------------------------
<style scoped>
.list-conatiner{
    border: solid 1px #c6c6c6;
    padding: 20px;
}
</style>