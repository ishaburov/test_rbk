<template>
    <div>
        <ArticleCard
                class="mb-2"
                :item="item"
                :description="item.description"
                :show-view="false"
        />
    </div>
</template>

<script>
    import Api from "../../api/Api";
    import ArticleCard from "../ArticleCard/ArticleCard";

    export default {
        name: "Article",
        components: {
            ArticleCard
        },
        data() {
            return {
                item: {},
                articleId: null,
            };
        },
        mounted() {
            this.articleId = this.$route.params['id'];
            this.getArticle();
        },
        methods: {
            async getArticle() {
                const {data} = await Api.getArticle(this.articleId);
                this.item = data.data;
            }
        }
    };
</script>

<style src="./article.css" scoped>

</style>