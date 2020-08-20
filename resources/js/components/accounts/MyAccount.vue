<template>
    <div class="position-relative h-full w-full bg-dark">
        <div class="px-0 mr-0 ml-auto col-10 col-md-3 fixed-bottom h-75 shadow-lg innyooty" style="z-index:1"
            :style="show ? '' : 'right:-500px'"
        >
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <div class="col-11">
                            My Account
                        </div>
                        <button type="button" class="close pr-2 text-right" data-dismiss="popup" aria-label="Close">
                            <span aria-hidden="true" @click="$emit('account')">×</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" @submit.prevent="updateAccount">
                        <div class="col-10 mx-auto my-2 px-0">
                            <label class="col-12 p-0 m-0">Name:</label>
                            <input class="col-12 p-0 m-0" v-model="user.name">
                        </div>

                        <div class="col-10 mx-auto my-2 px-0">
                            <label class="col-12 p-0 m-0">Email:</label>
                            <input class="col-12 p-0 m-0" v-model="user.email">
                        </div>

                        <div class="col-10 mx-auto my-2 px-0">
                            <label class="col-12 p-0 m-0 text-center">Accept Email Reminders:</label>
                            <input class="col-12 p-0 m-0" type="checkbox" v-model="user.accept_emails">
                        </div>

                        <div class="col-12 p-0 m-0 text-center">
                            <button type="submit" class="btn btn-primary mx-auto">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getUser();
    },
    data() {
        return {
            user: {},
        }
    },
    props: [ 'show' ],
    methods: {
        getUser() {
            axios
            .get('/whoami')
            .then(res => {
                this.user = res.data[1];
            })
        },
        updateAccount() {
            axios
                .post('/updateaccount', {
                    user: this.user
                })
                .then(res => {
                    this.$emit('account')
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
    }
}
</script>

<style scoped>
.innyooty {
    transition: left 2s, right 2s;
}
</style>