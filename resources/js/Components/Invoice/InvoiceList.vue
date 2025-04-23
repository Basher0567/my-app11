
<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable buttons-pagination alternating :headers="Header" :items="Item" :rows-per-page="10" :search-field="searchField"  :search-value="searchValue">
                                <template #item-number="{ id,total }">
                                    <button class="btn btn-success mx-3 btn-sm" @click="itemClick(id,total)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="itemClick(id,total)">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import {ref} from "vue";
import { usePage } from "@inertiajs/vue3";
const page=usePage()


const Header = [
    { text: "No", value: "id" },
    { text: "Customer", value: "customer.name"},
    { text: "Phone", value: "customer.mobile"},
    { text: "Email", value: "customer.email"},
    { text: "Total", value: "total"},
    { text: "Discount", value: "discount"},
    { text: "Vat", value: "vat"},
    { text: "Payable", value: "payable"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)


const itemClick = (id,total) => {
    alert(`Id is=${id} & Total is=${total}`)
}


</script>
