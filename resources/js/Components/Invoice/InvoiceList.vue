
<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable

                            buttons-pagination alternating
                            :headers="Header"
                            :items="Item"
                            :rows-per-page="10"
                            :search-field="searchField"
                            :search-value="searchValue">
                                <template #item-number="{ id,total }">
                                    <button @click="showDetails(id)" class="viewBtn btn btn-outline-dark text-sm px-3 py-1 btn-sm m-0"><i class="fa text-sm fa-eye"></i></button>
                                    <button class="btn btn-danger btn-sm" @click="deleteClick(id)" style="margin-left: 5px;">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <InvoiceDetails v-if="show" :customer="customer" @close="closeModal"/>
    </div>


</template>

<script setup>
import {ref} from "vue";
import { usePage,router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import InvoiceDetails from "./InvoiceDetails.vue";
const toaster = createToaster();

const page=usePage()

const show=ref(false)
const customer=ref()

const searchField=ref(['customer.name'])
const searchValue=ref()

const showDetails=(id)=>{
    show.value=!show.value
    customer.value=Item.value.find(item=>item.id==id)
}

const closeModal = () => {
    show.value = false
}

const Header = [
    { text: "No", value: "id" },
    { text: "Customer", value: "customer.name"},
    { text: "Customer_id", value: "customer.id"},
    { text: "Phone", value: "customer.mobile"},
    { text: "Email", value: "customer.email"},
    { text: "Total", value: "total"},
    { text: "Discount", value: "discount"},
    { text: "Vat", value: "vat"},
    { text: "Payable", value: "payable"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)

const deleteClick = (id) => {
    let text="Do You want to delete"
    if(confirm(text)===true){
        router.get(`delete-invoice/${id}`)
        alert(id)
        //toaster.success("Invoice Delete Successfully")
    }
    else{
        text="You Canceled"
    }
}

</script>
