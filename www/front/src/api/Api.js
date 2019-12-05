import Request from "../api/Request";

export default {
    getArticles(){
       return Request('rbc/articles/').get();
    },
    getArticle(articleId){
        return Request(`rbc/articles/${articleId}`).get();
    }
}