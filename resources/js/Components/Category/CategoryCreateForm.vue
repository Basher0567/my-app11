<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                   <form @submit.prevent="submit">
                    <div class="card-body">
                        <h4>Category Info</h4>
                        <br/>
                        <input id="name" name="name" v-model="form.name" placeholder="Category Name" class="form-control" type="text"/>
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

    const form=useForm({name:''})
    const page=usePage()
    function submit(){
        if(form.name.length===0){
        toaster.warning("Category Name Required")
        }
        else{
            form.post("/create-category",{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/CategoryPage")
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
