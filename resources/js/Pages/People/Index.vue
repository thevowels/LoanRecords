<template>

    <AppLayout title="People">
        <Container >
            <div v-if="people.data.length === 0 && !props.query" class="flex pt-40 items-center justify-center text-center space-y-8 flex-col">
                <div class="text-xl font-semibold ">
                    You don't have any people added yet.

                </div>
                <div class="font-mono text-gray-600">
                    You can start adding new people by clicking the Add People Button below

                </div>
                <div class="text-center mb-4 mr-2 flex ">
                    <a :href="route('people.create')" class="inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Add New Person</a>
                </div>
            </div>
            <div v-if="people.data.length !== 0 || props.query">
                <div class="text-right mb-4 mr-2 flex  flex-col sm:flex-row justify-between">
                    <div>
                        <div v-if="!filter">
                            <PrimaryButton @click=" () => filter=true" class="px-4 py-4">Filter</PrimaryButton>
                        </div>
                        <form @submit.prevent="search" class="m-3" v-if="filter">
                            <div class="space-y-2">
                                <div class="flex flex-wrap ">
                                    <select v-model="searchForm.sort"  @change="search">
                                        <option value="id">Latest</option>
                                        <option value="name">Name</option>
                                    </select>
                                    <label class="flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="sr-only"
                                            v-model="sortDesc"
                                            @change="toggleSortOrder"
                                        />
                                        <div class="w-11 h-6 bg-gray-300 rounded-full shadow-inner relative transition-colors duration-200 ease-in-out">
                                            <div
                                                class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition transform"
                                                :class="sortDesc ? 'translate-x-5' : ''"
                                            ></div>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-700">
            {{ sortDesc ? 'Newest First' : 'Oldest First' }}
        </span>
                                    </label>
                                </div>
                                <div class=" flex flex-wrap gap-2">
                                    <InputLabel for="query" class="sr-only">Search</InputLabel>
                                    <TextInput v-model="searchForm.query" id="query" class="w-full"/>
                                    <SecondaryButton type="submit">Search</SecondaryButton>
                                    <DangerButton v-if="searchForm.query" @click="clearSearch">Reset</DangerButton>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div v-if="!filter">
                        <a :href="route('people.create')" class="inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Add New Person</a>
                    </div>

                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-4 ">
                    <div v-for="consumer in people.data" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 min-w-full  ">

                        <div class="flex flex-row">
                            <div class="flex w-48 p-2">
                                <img :src="consumer.portrait_url" class="rounded rounded-lg"/>
                            </div>
                            <div>
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center ">{{consumer.name}}</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400">{{consumer.city}}</p>

                            </div>
                        </div>
                        <div class="text-center">
                            <a :href="route('people.show', consumer)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Details</a>
                        </div>
                    </div>
                </div>
                <div v-if="people.meta.last_page !== 1">
                    <Pagination :meta="props.people.meta"></Pagination>
                </div>
            </div>
            <div v-if="people.data.length === 0 && props.query" class="flex pt-40 items-center justify-center text-center space-y-8 flex-col">
                Your search result is empty
            </div>

        </Container>
    </AppLayout>


</template>
<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {ref} from "vue";



const props = defineProps(['people', 'query', 'sort', 'sortOrder']);

const page = usePage();

const sortDesc = ref(props.sortOrder == 'asc');
const filter = ref(false);

const searchForm = useForm({
    query: props.query,
    sort: props.sort || 'id',
    sortOrder: props.sortOrder || 'asc',
    page: 1
});

const search = () => searchForm.get(page.url);
const toggleSortOrder = () => {
    searchForm.sortOrder = sortDesc.value ? 'asc' : 'desc';
}

const clearSearch = () => {
    searchForm.query = "";
}

</script>
