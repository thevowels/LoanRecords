<template>
    <AppLayout title="Users">
        <Container>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <Card v-for="user in users.data" :key="user.id" @click="goTo(user.id)">
                    <CardHeader>
                        <div class="flex flex-row justify-around gap-0 space-x-0 items-center">
                            <div >
                                <Avatar class="w-16 h-16">
                                    <AvatarImage src="https://github.com/shadcn.png" />
                                    <AvatarFallback>CN</AvatarFallback>
                                </Avatar>

                            </div>
                                <div class="ml-4">
                                    <h1 class="text-lg font-bold">{{user.name}}</h1>
                                    <h1 class="text-sm text-gray-600">{{ user.email }}</h1>
                                </div>
                        </div>
                        <CardDescription>
                            asdf
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div v-if="user.limits[0]" v-for="limit in user.limits">
                            <div class="flex justify-between mb-1">
                                <span class="text-base font-medium text-blue-700 dark:text-white">Limit: {{limit.limit}}</span>
                                <span class="text-sm font-medium text-blue-700 dark:text-white">{{percentage(limit)}}</span>
                            </div>
                            <div class="w-full bg-blue-600 rounded-full h-4 dark:bg-gray-700">
                                <div class="bg-amber-600 h-4 rounded-full" :style="{width: percentage(limit)}"></div>
                            </div>
                            <div class="flex justify-between mb-1">
                                <span class="text-base font-medium text-blue-700 dark:text-white"></span>
                                <span class="text-sm font-medium text-amber-600 dark:text-white">Used : {{limit.usedAmount}} {{limit.currency}}</span>
                            </div>
                        </div>
                        <div v-else>
                        No limit Yet
                        </div>
                    </CardContent>
                </Card>
            </div>
        </Container>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {route} from 'ziggy-js';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"

const props = defineProps(['users']);

const percentage = (limit) => {
    return Math.floor((limit.usedAmount / limit.limit) * 100) + '%';
};

const goTo = (id: string) => {
    window.location.href = route('admin.users.show', id);
}

</script>
