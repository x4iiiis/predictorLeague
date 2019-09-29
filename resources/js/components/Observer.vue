<template>
  <div class="observer"></div>
</template>

<script>
export default {
    name: "Observer",
    mounted() {
        this.observer = new IntersectionObserver(([entry]) => {
            if(entry && entry.isIntersecting) {
                console.log('Load more results!');
                this.$emit('intersect');
            }
        });
        this.observer.observe(this.$el);
    },
    data() {
        return {
            observer: null
        };
    },

}
</script>

