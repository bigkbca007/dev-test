<template>
    <div>
        <strong>{{ item.nome }}</strong>
        <button v-if="remover == 1" @click="removerCategoria()" class="btn btn-link" style="float:right">
            remover
        </button>
    </div>
</template>

<script>
export default {
    props: [
        'item',
        'remover'
    ],
    methods: {
        removerCategoria() {
            axios.delete('/categorias/' + this.item.id)
            .then(res => {
                if(res.status == 200){
                    this.$emit('listamudada');
                }
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
}
</script>

<style scoped>
</style>