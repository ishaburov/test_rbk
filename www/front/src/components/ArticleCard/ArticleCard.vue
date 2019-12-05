<template>
    <v-card class="article">
        <div class="title font-weight-bold mb-2"> {{ item.title }}</div>
        <div
                v-if="item.image"
                class="article__image mb-2"
        >
            <img :src="item.image">
        </div>
        <div class="body-1 mb-2"> {{ description }}</div>
        <v-btn v-if="showView"
               block
               :to="`/articles/${item.id}`"
        >
            Подробнее
        </v-btn>
    </v-card>
</template>

<script>

    export default {
        name: "NewsCard",
        props: {
            item: {
                require: true,
                type: Object
            },
            description: {
                require: true,
                type: String
            },
            showView: {
                type: Boolean,
                default: true
            }
        },
        mounted() {

        }
    };
</script>

<style src="./article_card.css" scoped>

</style>