

<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable buttons-pagination alternating :headers="Header" :items="Item" :rows-per-page="10" :search-field="searchField"  :search-value="searchValue">
                                <template #item-number="{ number,player }">
                                    <button class="btn btn-success mx-3 btn-sm" @click="itemClick(number,player)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="itemClick(number,player)">Delete</button>
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
    { text: "Name", value: "name"},
    { text: "Email", value: "email"},
    { text: "Mobile", value: "mobile"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)


const itemClick = (number,player) => {
    alert(`Number is=${number} & Player Name is=${player}`)
}


</script>

