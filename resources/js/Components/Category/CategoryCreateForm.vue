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
    import { useForm,usePage,router, Link } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    import {ref} from 'vue';
    const toaster = createToaster();

    const urlParam = new URLSearchParams(window.location.search);
    let id = ref(parseInt(urlParam.get("id")));
   

    const form=useForm({name:'', id:id});
    const page=usePage()

    let URL = "/create-category";
    let list = page.props.list;

    if(id.value !==0 && list !==null){
        URL = "/update-category";
        form.name = list.name
    }

    function submit(){
        if(form.name.length===0){
            toaster.warning("Category Name Required")
        }else{
            form.post(URL,{
                onSuccess: () =>{
                    if(page.props.flash.status===true){
                        router.get("/CategoryPage")
                        toaster.success(page.props.flash.message)
                    }              else{
                        toaster.warning(page.props.flash.message)
                    }
                }
            })
        }
     }
</script>
