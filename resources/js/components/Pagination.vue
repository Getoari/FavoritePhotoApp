<template>
    <div class="row">
        <div class="col-sm">
            <button v-if="this.page_start > 0" @click="pagination('prev')" class="btn btn-primary">Previous</button>
        </div>
        <div class="col-sm my-2">
            <p class="text-center">Page: {{this.page_start+1}}</p>
        </div>
        <div class="col-sm">
            <button v-if="this.page_start != 5000-this.page_limit" @click="pagination('next')" class="btn btn-primary float-right">Next</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page_start: 0,
                page_limit: 9
            }
        },
        methods: {
            pagination(page) {
                if (page == 'next')
                    this.page_start += 1;
                else 
                    this.page_start -= 1;

                this.$emit('pagination', this.page_start*this.page_limit);
            }
        }
    }
</script>
