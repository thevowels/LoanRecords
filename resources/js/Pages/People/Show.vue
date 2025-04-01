<template>
    <AppLayout>
        <Container>
            <div class="asdf">
                asdf
            </div>
            <div class="container">
                <div class="grid grid-cols-1 sm:grid-cols-2">
                    <div>
                        <img src="https://dummyjson.com/icon/abc123/512" width="512" height="512"/>
                    </div>
                    <div class="space-y-2">
                        <h1 class="text-left text-xl font-bold pl-8">{{ consumer.name }}</h1>
                        <p v-if="consumer.phone"><span class="font-bold">Phone:</span> {{consumer.phone}}</p>
                        <p v-if="consumer.email">{{consumer.email}}</p>
                        <p>
                            <span v-if="consumer.identification_type" class="mr-2">{{ consumer.identification_type}}</span>
                            <span v-if="consumer.identification_number" > {{consumer.identification_number}}</span>
                        </p>
                        <p>{{consumer.country}}</p>
                        <p>{{consumer.city}}</p>
                        <div class="py-3 border border-indigo-600 rounded-lg text-center font-bold text-lg">
                            Outstanding Amount
                            <div>{{consumer.amount}}</div>
                        </div>
                        <div class="py-4">
                            <Link :href="route('people.destroy', consumer)" method="delete" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                Archive
                            </Link>
                        </div>
                    </div>
                </div>

                <div>
                    Loan Records
                </div>
            </div>
        </Container>
    </AppLayout>
</template>
<script setup >

import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['consumer'])
import {Link} from "@inertiajs/vue3";
import Container from "@/Components/Container.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
