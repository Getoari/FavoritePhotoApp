<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Favorite Photo App</div>

                    <div class="card-body">
                        <div v-if="isWeekend">
                            <MostFavoritedUsers />
                        </div>
                        <div v-else>
                            <PhotoSlideShow />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MostFavoritedUsers from './MostFavoritedUsers.vue';
    import PhotoSlideShow from './PhotoSlideShow.vue';
    
    export default {
        data() {
            return {
                loading: true,
                photos: []
            }
        },
        components: {
            MostFavoritedUsers,
            PhotoSlideShow
        },
        computed: {
            isWeekend: function () {
                
                let today = new Date();
                    if(today.getDay() == 6 || today.getDay() == 0)
                        return true

                return false
            }
        }   
    }
</script>

<style scoped>
    .loader-container  {
        width: 400px;
        height: 400px;
    }
</style>
