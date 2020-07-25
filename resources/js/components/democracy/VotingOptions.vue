<template>
    <div>
        <button 
            v-for="option in options" 
            @click="vote(option)"
            class="col-7 mx-auto my-3"
        >
            {{ option }}
        </button>
    </div>
</template>

<script>
export default {
    methods: {
        vote(answer) {
            axios
                .post('/vote', { vote: answer, user_id: this.user.id })
                .then((response) => {
                    // console.log('Vote received');
                    this.$emit('voted');
                })
                .catch(err => {
                    console.log(err.response);
                })
        }
    },
    props: [
        'options',
        'user',
    ]
}
</script>