<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                   <form @submit.prevent="submit">
                    <div class="card-body">
                        <h4>Customer Info</h4>
                        <br/>
                        <input id="name" name="name" v-model="form.name" placeholder="Customer Name" class="form-control" type="text"/>
                        <br/>
                        <input id="email" name="email" v-model="form.email" placeholder="Email" class="form-control" type="text"/>
                        <br/>
                        <input id="mobile" name="mobile" v-model="form.mobile" placeholder="Phone Numer" class="form-control" type="text"/>
                        <br/>
                        <button type="submit" class="btn w-100 btn-success">Save Change</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useForm,usePage,router } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster();

    const form=useForm({name:'',email:'',mobile:''})
    const page=usePage()
    function submit(){
        if(form.name.length===0){
        toaster.warning("Customer Name Required")
        }
        else if(form.email.length===0){
        toaster.warning("Customer Email Required")
        }
        else if(form.mobile.length===0){
        toaster.warning("Customer Phone Number Required")
        }
        else{
            form.post("/create-customer",{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/CustomerPage")
                    toaster.success(page.props.flash.message)
                }
                else{
                    toaster.warning(page.props.flash.message)
                }
            }
        })
        }
     }
</script>
