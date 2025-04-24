

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
                                    <button class="btn btn-success mx-3 btn-sm" @click="itemClick(id,name)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="deleteClick(id)">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                        <Link class="btn btn-success my-3" href="/CustomerSavePage">Create New</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import {ref} from "vue";
import {Link,useForm,usePage,router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster();
const page=usePage()


const Header = [
    { text: "No", value: "id" },
    { text: "Name", value: "name"},
    { text: "Email", value: "email"},
    { text: "Mobile", value: "mobile"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)
if(page.props.flash.status===true){
        toaster.success('Customer Deleted successfully');
}
if(page.props.flash.status===false){
        toaster.warning('Customer Delete Not successfully');
}

const deleteClick = (id) => {
    router.get(`/delete-customer/${id}`)
}

const itemClick = (id,name) => {
    alert(`ID is=${id} & Name is=${name}`)
}


</script>

