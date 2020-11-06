<template>
    <div>
        <div v-if="photo_url" style="text-align: center;">
            <img :alt="photo_name" class="img-responsive center-block mx-auto" :src="photo_url" />
            <div>
                <div class="row mt-5">
                    <div class="col-sm">
                        <button v-if="this.count != 0" @click="pagination('prev')" class="btn btn-primary float-left">Previous</button>
                    </div>
                    <div class="col-sm">
                        <button v-if="this.count < total-1" @click="pagination('next')" class="btn btn-primary float-right">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PhotoSlideShow",
    data() {
        return {
            count: 0,
            total: 0,
            photos: [],
            photo_url: "",
            photo_name: ""
        }
    },
    methods: {
        pagination(page) {
            if (page == 'next')
                this.count += 1;
            else
                this.count -= 1;

            this.getPhoto(this.photos[this.count])
        },
        getPhoto(id) {
            axios.get(`http://jsonplaceholder.typicode.com/photos/${id}`)
                .then(res => {
                    this.photo_url = res.data.url
                    this.photo_name = res.data.name                    
                }).catch(err => console.log(err));
        }
    },
    created() {
        axios.get(`/api/favorite-photos`)
        .then(res => {
            this.photos = res.data
            this.total = res.data.length

            this.getPhoto(res.data[0])
        }).catch(err => console.log(err));
    }
}
</script>