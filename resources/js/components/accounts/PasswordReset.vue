<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>

                    <div v-if="!resetSuccessful" class="card-body">
                        <form v-if="!accountFound" method="POST" @submit.prevent="checkEmailExists">

                            <input type="hidden" name="_token" :value="csrf">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus>
                                    <small v-if="wrongEmail" class="text-danger">No accounts were found with this email address</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                        <form v-if="accountFound" method="POST" @submit.prevent="resetPassword">

                            <p><small>Welcome back, {{ user.name }}!</small></p>
                            <p><small>Let's get your password changed, since yer a fanny and forgot what it was!</small></p>
                            <p><em>I haven't gone to a lot of effort with security here, so I'd <strong><u><mark>strongly advise</mark></u></strong> not using a password you use for important/sensitive accounts.</em></p>

                            <input type="hidden" name="_token" :value="csrf">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input v-model="newPassword" type="password" class="form-control" required autofocus>
                                    <small v-if="passwordError" v-for="errorMessage in passwordErrors" class="text-danger">{{ errorMessage }}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">New Password Confirmation</label>

                                <div class="col-md-6">
                                    <input v-model="newPasswordConfirmation" type="password" class="form-control" required autofocus>
                                    <small v-if="passwordMatchError" class="text-danger">The passwords you entered didn't match you donut!</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>

                    <div v-else class="card-body">
                        <p>Success! Your password has now been reset.</p>

                        <p>Logging in . . .</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            wrongEmail: false,
            accountFound: false,
            user: [],
            newPassword: '',
            newPasswordConfirmation: '',
            passwordError: false,
            passwordErrors: [],
            passwordMatchError: false,
            resetSuccessful: false,
            
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        checkEmailExists() {
            axios
                .post('/user/checkemailexists', { 
                    _token: this.csrf,
                    email: this.email,
                })
                .then(res => {
                    if(res.data) {
                        this.wrongEmail = false;
                        this.user = res.data;
                        this.accountFound = true;
                    }
                    else {
                        this.wrongEmail = true;
                    }
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        resetPassword() {
            if(this.newPassword == this.newPasswordConfirmation) {
                this.passwordMatchError = false;

                axios
                    .post('/user/resetpassword', { 
                        _token: this.csrf,
                        id: this.user.id,
                        newPassword: this.newPassword
                    })
                    .then(res => {
                        console.log(res);
                        if(res.data != 'Password updated successfully.') {
                            this.passwordErrors = res.data.newPassword;
                            this.passwordError = true;
                        }
                        else {
                            this.passwordError = false;
                            this.passwordErrors = [];

                            this.resetSuccessful = true;

                            setTimeout(window.location.href = '/', 5000);
                        }
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
            else {
                this.passwordMatchError = true;
            }
        }
    }
}
</script>