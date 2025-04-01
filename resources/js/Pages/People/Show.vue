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
                        <div class="py-4 border border-indigo-600 rounded-lg text-center font-bold text-lg">
                            Outstanding Amount
                            <div>{{consumer.amount}}</div>
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

const props = defineProps(['consumer'])
import Container from "@/Components/Container.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
