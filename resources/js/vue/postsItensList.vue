<template>
    <div class="list-container">
        <div v-for="(item, index) in items" :key="index">
            <post-item 
                :item="item"
                :remover="remover"
                class="item"
                v-on:listamudada="$emit('recarregarLista')"
            />
        </div>
    </div>
</template>

<script>
import postItem from './postItem';
export default {
    props:['items', 'remover'], // Passado pelo componente pai
    components: {
        postItem
    }
}
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
    border: solid 1px #cccccc;
}
</style>