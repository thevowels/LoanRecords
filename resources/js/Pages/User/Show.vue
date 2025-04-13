<template>
    <AppLayout title="">
        <Container>
            <div class="max-w-xl mx-auto space-y-4">
                <Card class=" mx-auto">
                    <CardHeader>
                        <div class="flex flex-row justify-between gap-0 space-x-0 items-center">
                            <div class="basis-1/6">
                                <Avatar>
                                    <AvatarImage src="https://github.com/shadcn.png" />
                                    <AvatarFallback>CN</AvatarFallback>
                                </Avatar>

                            </div>
                            <div class="basis-2/3 pl-4">
                                <h1 class="text-lg font-bold">{{user.name}}</h1>
                                <h1>{{ user.email }}</h1>
                            </div>
                            <div class="basis-1">
                                <SecondaryButton class="text-xs font-light" @click="goTo(user.id)">
                                    Edit
                                </SecondaryButton>
                            </div>
                        </div>
                        <div class="flex flex-row justify-between ">
                            <div class="mx-auto">
                                ABCD
                            </div>
                            <div class="mx-auto">
                                XYZK
                            </div>
                        </div>
                    </CardHeader>
                </Card>
                <div class="text-right">
                    <PrimaryButton>
                        Add Limit
                    </PrimaryButton>
                </div>
                <Card v-for="limit in user.limits" class=" mx-auto">
                    <CardHeader>
                        <UserLimit :limit="limit"/>
                    </CardHeader>
                </Card>


            </div>
        </Container>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {route} from "ziggy-js";
import UserLimit from "@/Components/User/UserLimit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const goTo = (id: string) => {
    window.location.href = route('admin.users.edit', id);
}

const props = defineProps(["user"])
</script>
