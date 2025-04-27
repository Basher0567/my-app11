<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <form @submit.prevent="submit">
                        <div class="card-body">
                            <h4>Product Info</h4>
                            <br/>
                            <input id="name" name="name" v-model="form.name"  placeholder="Product Name" class="form-control" type="text"/>
                            <br/>
                            <input id="price" name="price" v-model="form.price" placeholder="Price" class="form-control" type="text"/>
                            <br/>
                            <input id="unit" name="unit" v-model="form.unit"  placeholder="Unit" class="form-control" type="text"/>
                            <br/>
                            <input id="categoryId" name="categoryId" v-model="form.category_id"  placeholder="Category_id" class="form-control" type="text"/>
                            <br/>
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
    import { usePage,useForm,router } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    import { ref } from 'vue';
    const toaster = createToaster();

    const urlParam=new URLSearchParams(window.location.search)
    const id=ref(parseInt(urlParam.get("id")))

    const form=useForm({name:'',price:'',unit:'',category_id:'',id:id})
    const page=usePage()

    let URL="/create-product"
    let list=page.props.list

    if(id.value!==0 && list!==null){
        URL="/update-product"
        form.name=list.name
        form.price=list.price
        form.unit=list.unit
        form.category_id=list.category_id
    }

    function submit(){
        if(form.name.length===0){
        toaster.warning("Product Name Required")
        }
        else if(form.price.length===0){
        toaster.warning("Price Required")
        }
        else if(form.unit.length===0){
        toaster.warning("Unit Required")
        }
        else if(form.category_id.length===0){
        toaster.warning("Category Id Required")
        }
        else{
            form.post(URL,{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/ProductPage")
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


