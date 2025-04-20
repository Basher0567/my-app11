
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card animated fadeIn w-100 p-3">
                 <form @submit.prevent="submit">
                    <div class="card-body">
                        <h4>User Profile</h4>
                        <hr/>
                        <div class="container-fluid m-0 p-0">
                            <div class="row m-0 p-0">
                                <div class="col-md-4 p-2">
                                    <label>Email Address</label>
                                    <input readonly id="email" v-model="form.email" placeholder="User Email" class="form-control" type="email"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>First Name</label>
                                    <input id="firstName" v-model="form.firstName" placeholder="First Name" class="form-control" type="text"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>Last Name</label>
                                    <input id="lastName" v-model="form.lastName" placeholder="Last Name" class="form-control" type="text"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>Mobile Number</label>
                                    <input id="mobile" v-model="form.mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>Password</label>
                                    <input id="password" v-model="form.password" placeholder="User Password" class="form-control" type="password"/>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-md-4 p-2">
                                    <button  class="btn mt-3 w-100 btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
    import { useForm,usePage } from '@inertiajs/vue3';
    const form=useForm({
        firstName:'',lastName:'',email:'',mobile:'',password:''})
    const page=usePage()
    function submit(){

    }
</script>


