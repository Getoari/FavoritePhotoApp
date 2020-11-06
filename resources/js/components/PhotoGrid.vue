<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Favorite Photo App</div>

                    <div class="card-body">
                        <Photos v-if="!loading" v-bind:photos="photos" />
                        <div v-else class="loader-container">
                            <div class="loader"></div>
                        </div>
                        <Pagination v-on:pagination="paginatePage" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Photos from './Photos.vue';
    import Pagination from './Pagination.vue';

    export default {
        name: "PhotoGrid",
        data() {
            return {
                loading: true,
                photos: []
            }
        },
        components: {
            Photos,
            Pagination
        },
        methods: {
            paginatePage(page) {
                this.loading = true;
                axios.get(`http://jsonplaceholder.typicode.com/photos?_limit=9&_start=${page}`)
                    .then(res => {
                        this.photos = res.data
                        this.loading = false
                    }).catch(err => console.log(err));
            }
        },
        created() {
            axios.get('http://jsonplaceholder.typicode.com/photos?_limit=9')
            .then(res => {
                this.photos = res.data
                this.loading = false
            }).catch(err => console.log(err));
        }
        
    }
</script>

<style scoped>
    .loader-container  {
        width: 400px;
        height: 400px;
    }
</style>
