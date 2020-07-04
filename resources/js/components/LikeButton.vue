<template>
    <div>
        <div>
            <span 
                class="like-btn" 
                @click="saveLike($event)"
                :class="{ 'like-active' : isActive }"
            ></span>
            <p>{{ cantidadLikes }} Les gustó esta receta</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['recipeid', 'likes', 'countlikes'],
        data: function () {
            return {
                totalLikes: this.countlikes,
                isActive: this.likes
            }
        },
        methods: {
            saveLike(e){
                $(e.target).toggleClass('like-active');
                axios.post(`/recetas/${this.recipeid}`).then((res)=> {
                    if (res.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    }else {
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive;


                }).catch((error) => {
                    if(error.response.status === 401) window.location = '/register';
                });
            }
        },
        computed: {
            cantidadLikes: function () {
                return this.totalLikes;
            }
        },
    }
</script>