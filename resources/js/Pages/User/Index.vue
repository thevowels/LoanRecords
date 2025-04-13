<template>
    <AppLayout title="users">
        <Container>
            <h1>
                Users Index page
            </h1>

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
                            Limit: {{limit.limit}}  Used: {{limit.usedAmount}}
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

const goTo = (id: string) => {
    window.location.href = route('admin.users.show', id);
}

</script>
