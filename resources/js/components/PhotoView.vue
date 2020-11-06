<template>
    <div class="modal" tabindex="-1" v-show="value">
        <div id="backdrop"></div>
        <div v-if="!loading" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="padding: 4px;">{{photo.title}}</h5>        

                <button @click="favorite" class="btn btn-primary" style="margin-left: auto;">
                    <span v-if="toggleFavorite">Unfavorite</span>
                    <span v-else>Favorite</span>
                </button>
                
                <button @click.prevent="close" style="margin-left: 0; padding: 22px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            
            </div>
            <div class="modal-body m-auto">
                <img alt="" class="img-responsive center-block" :src="photo.url" />
            </div>
            </div>
        </div>
        <div v-else>
            <div class="loader"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    data() {
        return {
            loading: true,
            toggleFavorite: false,
            photo: [],
        };
    },
    props: {
        favorited: Boolean,
        value: {
            required: true
        }
    },
    methods: {
        favorite() {
            axios.post('/api/favorite-photos', {
                photo_id: this.photo.id
            })
                .then(res => {
                    this.toggleFavorite = !this.toggleFavorite
                    this.$emit('add-favorite', this.photo.id)})
                .catch(err => console.log(err));
        },
        close() {
            this.$emit("input", false);
        }            
    },
    watch: {
        value: function() {
            if(this.value) {
                this.loading = true;
                this.toggleFavorite = this.favorited;
                axios.get(`http://jsonplaceholder.typicode.com/photos/${this.value}`)
                    .then(res => {
                        this.photo = res.data
                        this.loading = false;
                    }).catch(err => console.log(err));
            }
        }
    }
};
</script>

<style scoped>
.modal {
    display: block;
    overflow: overlay;
}

body.modal-open {
  overflow: hidden !important;
}

#backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 0;
  background-color: #000;
  opacity: 0.5;
}
</style>