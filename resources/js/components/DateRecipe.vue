<template>
    <small v-text="formatedDate"></small>
</template>


<script>
    export default {
        props:['date'],
        mounted() {
        },
        computed: {
            formatedDate(){
                return moment(this.date).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        },
    }
</script>