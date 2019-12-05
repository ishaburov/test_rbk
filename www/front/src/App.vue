<template>
    <v-app>
        <v-app-bar
                color="#37bc9b"
                dark
                fixed
                app
        >
            <v-layout justify-space-between>
                <v-layout align-center>
                    <v-toolbar-title>Application</v-toolbar-title>
                </v-layout>
                <v-layout>
                  <v-btn to="/articles">Articles</v-btn>
                </v-layout>
            </v-layout>
        </v-app-bar>
        <v-content>
            <v-container fluid>
                <template>
                    <router-view/>
                </template>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

    export default {
        async mounted() {

        },
        computed: {},
        methods: {}
    };
</script>

<style>
    @import "assets/style.css";
</style>
