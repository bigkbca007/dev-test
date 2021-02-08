<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <categorie-item 
                :item="item"
                :remover="remover"
                class="item"
                v-on:listamudada="$emit('recarregarLista')"
            />
        </div>
        
    </div>
</template>

<script>
import categorieItem from './categorieItem';
export default {
    props:['items', 'remover'], // Passado pelo componente pai
    components: {
        categorieItem
    }
}
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>