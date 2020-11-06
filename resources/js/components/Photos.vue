<template>
    <div class="row image-grid">
        <div v-bind:key="photo.id" v-for="photo in photos" class="col-md-4">
            <button class="btn" @click="openModal(photo.id)">
                <span v-if="favorited(photo.id)" class="badge badge-success">Favorited</span>
                <PhotoItem v-bind:photo="photo" />
            </button>
        </div>
        <PhotoView v-model="modalOpen" v-on:add-favorite="addFavorite" v-bind:favorited="favorited(modalOpen)" />
    </div>
</template>

<script>
import PhotoItem from './PhotoItem.vue';
import PhotoView from './PhotoView.vue';

export default {
    name: "Photos",
      components: {
        PhotoItem,
        PhotoView
    },
    data() {
        return {
            modalOpen: false,
            favoritePhotos: []
        };
    },
    created() {
        axios.get('api/favorite-photos/user')
            .then(res => {
                this.favoritePhotos = res.data
            }).catch(err => console.log(err))
    },
    methods: {
        openModal(id) {
            this.modalOpen = id
        },
        favorited(id) {
            if(this.favoritePhotos.includes(id))
                return true;

            return false;
        },
        addFavorite(id) {
            if(this.favoritePhotos.includes(id))
                this.favoritePhotos = this.favoritePhotos.filter(item => item !== id)
            else
                this.favoritePhotos = [...this.favoritePhotos, id]
        }
    },
    props: ["photos"]
}
</script>

<style scoped>
    .badge {
        position: absolute;
        z-index: 1;
        top: 0px;
        left: 100px;
    }
</style>

