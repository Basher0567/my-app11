<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable buttons-pagination alternating :headers="Header" :items="Item" :rows-per-page="10" :search-field="searchField"  :search-value="searchValue">
                                <template #item-number="{ id,name }">
                                    <Link class="btn btn-success mx-3 btn-sm" href="/CategorySavePage?id={{ id }}">Edit</Link>
                                    <button class="btn btn-danger btn-sm" @click="deleteClick(id)">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                        <Link class="btn btn-success my-2" href="/CategorySavePage">Create New</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import {Link,usePage,router } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster();
    const page=usePage()

    const Header = [
    { text: "No", value: "id" },
    { text: "Name", value: "name"},
    { text: "Action", value: "number"},
    ];

const Item=ref(page.props.list)
if(page.props.flash.status===true){
        toaster.success('Category Deleted successfully');
}
if(page.props.flash.status===false){
        toaster.warning('Category Delete Not successfully');
}

const deleteClick=(id)=>{
    let text="Do you want to Delete"
    if(confirm(text===true)){
        router.get(`/delete-category/${id}`)
    }
    else{
        text="You canceled"
    }
}


</script>



