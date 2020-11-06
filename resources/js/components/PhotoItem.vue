<template>
    <div class="card">
        <div  class="card-body">
            <img alt="" class="img-responsive center-block" :src="photo.thumbnailUrl" />
        </div>
        <div class="card-footer">
            <i class="fa fa-camera-retro" aria-hidden="true"></i>
            {{photo.title}}
        </div>
    </div>
</template>

<script>
export default {
    name: "PhotoItem",
    props: ["photo"]
}
</script>