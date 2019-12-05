<template>
    <v-container>
        <v-layout
                wrap
                class="articles"
                justify-center
        >
            <v-flex v-for="item of items"
                    :key="item.id"
                    xs3
                    class="articles__card">
                <ArticleCard
                        class="mb-2"
                        :item="item"
                        :description="item.short_description"
                />
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Api from "../../api/Api";
    import ArticleCard from "../ArticleCard/ArticleCard";

    export default {
        name: "News",
        components: {
            ArticleCard
        },
        data() {
            return {
                items: []
            };
        },
        mounted() {
            this.getArticles();
        },
        methods: {
            async getArticles() {
                const {data} = await Api.getArticles();
                this.items = data.data;
            }
        }
    };
</script>

<style src="./article.css" scoped>

</style>