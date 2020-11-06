<template>
    <div>
        <h3>Users with most favorited photos in this week:</h3>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Photos Favorited</th>
                </tr>
            </thead>
            <tbody>
                <tr v-bind:key="user.id" v-for="user in this.users">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.favorite_photos_count}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "MostFavoritedUsers",
    data() {
        return {
            loading: true,
            users: []
        }
    },
    created() {
        axios.get('/api/favorite-photos/user/week')
        .then(res => {
            this.users = res.data
            this.loading = false
        }).catch(err => console.log(err));
    }
}
</script>