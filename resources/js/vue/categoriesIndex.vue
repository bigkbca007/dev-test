<template>
    <div class="list-container">
        <!-- Lista de categorias -->
        <categories-itens-list :items="items" :remover="remover" />
    </div>
</template>

// Javascript ------------------------------------------------
<script>
import categoriesItensList from './categoriesItensList';
export default {
    components: {
        categoriesItensList
    },
    data: function(){
        return {
            items: [],
            remover: 0
        }
    },
    methods: {
        getCategorias: function(){
            axios.get('/categorias/buscar', {
                params: {
                    termos: ''
                }
            }).then(res => {
                this.items = res.data;
            });
        },

    },
    created(){
        this.getCategorias()
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