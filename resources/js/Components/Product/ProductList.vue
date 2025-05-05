
<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <Link href="/ProductSavePage?id=0" class="btn btn-success mx-3 btn-sm">
                                Add Product
                            </Link>
                        </div>
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable
                            show-index
                            buttons-pagination alternating
                            :headers="Header"
                            :items="Item"
                            :rows-per-page="10"
                            :search-field="searchField"
                            :search-value="searchValue">
                                <template #item-number="{ id,name }">
                                    <a class="btn btn-success mx-3 btn-sm" :href="`ProductSavePage?id=${id}`">Edit</a>
                                    <button class="btn btn-danger btn-sm" @click="deleteClick(id)">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                        <Link class="btn btn-success my-3" href="/ProductSavePage">Create New</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import {ref} from "vue";
import { usePage,router,Link } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
const page=usePage()

const Header = [
    //{ text: "No", value: "id" },
    { text: "Name", value: "name"},
    { text: "Price", value: "price"},
    { text: "Unit", value: "unit"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)
const categories = ref(page.props.categories)
const searchValue=ref()

const deleteClick = (id) => {
    let text="Do you want to delete"
    if(confirm(text)===true){
        router.get(`/delete-product/${id}`)
        toaster.success('Product Deleted successfully');
    }
    else{
        text="You canceled"
    }

}



</script>
