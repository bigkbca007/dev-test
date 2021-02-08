<template>
    <div>
        <img :src="getImage(item.img_post)" class="img_post">
        <strong>{{ item.titulo }}</strong>&nbsp;
        <small v-if="remover == 0" class="text-info"><strong>Criado em: </strong>{{ item.created_at }}</small>&nbsp;
        
        <span style="float:right">
            <a :href="getLink(item.id)" class="btn btn-link">Visualisar</a>
            <a v-if="remover == 1" @click="removerPost()" class="btn btn-link text-danger">Remover</a>
        </span>
    </div>
</template>

<script>
export default {
    props: [
        'item',
        'remover'
    ],
    methods: {
        removerPost() {
            axios.delete('/posts/' + this.item.id)
            .then(res => {
                if(res.status == 200){
                    this.$emit('listamudada');
                }
            })
            .catch(error => {
                console.error(error);
            });
        },
        getImage(img_post){
            return '/images/'+img_post;
        },
        getLink(id){
            return '/posts/'+id;
        }
    }
}
</script>

<style scoped>
    .img_post{
        width: 50px;
    }
</style>