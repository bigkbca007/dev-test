<template>
    <div>
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image" class="img_post">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                <div class="media-left">
                </div>
                    <div class="media-content">
                        <p class="title is-4">{{ autor }}</p>
                        <p class="subtitle is-6">{{ email }}</p>
                    </div>
                </div>

                <div class="content">
                    <p>{{ conteudo }}</p>
                    <br>
                    <time datetime="2016-1-1">{{ created_at }}</time>
                </div>
            </div>
        </div>
    </div>
</template>

// Javascript ------------------------------------------------
<script>
export default {
    props: {
        id: String,
        titulo: String,
        img_post: String,
        conteudo: String,
        categoria: String,
        autor: String,
        email: String,
        created_at: String,
        updated_at: String
    }
}
</script>

// Style -----------------------------------------------------
<style scoped>
    .img_post{
        width: 300px
    }
</style>