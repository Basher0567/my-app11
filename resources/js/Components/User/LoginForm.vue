<template>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
                <div class="card w-90  p-4">
                   <form @submit.prevent="submit">
                    <div class="card-body">
                        <h4>SIGN IN</h4>
                        <br/>
                        <input id="email" v-model="form.email" placeholder="User Email" class="form-control" type="email"/>
                        <br/>
                        <input id="password" v-model="form.password" placeholder="User Password" class="form-control" type="password"/>
                        <br/>
                        <button type="submit" class="btn w-100 btn-success">Login</button>
                        <hr/>
                        <div class="float-end mt-3">
                            <span>
                                <Link class="text-center ms-3 h6" href="/RegistrationPage">Sign Up</Link>
                                <span class="ms-1">|</span>
                                <Link class="text-center ms-3 h6" href="/SendOTPPage">Forget Password</Link>
                            </span>
                        </div>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {Link,useForm,usePage,router} from '@inertiajs/vue3'
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster();

    const form=useForm({email:'',password:''})
    const page=usePage()
    function submit(){
        if(form.email.length===0){
            toaster.error('Email Required')
        }
        else if(form.password.length===0){
            toaster.warning('Password Required')
        }
        else{
            form.post("/user-login",{
                onSuccess:()=>{
                    if(page.props.flash.status===true){
                        toaster.success(page.props.flash.message);
                        router.get('/DashboardPage')
                    }
                    else{
                        alert(page.props.flash.message)
                    }
                }
            })
        }
    }
</script>


