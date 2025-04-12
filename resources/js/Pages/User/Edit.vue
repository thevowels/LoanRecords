<template>
    <AppLayout title="Update User">
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
                                <button class=" text-xs font-light border border-black rounded-xl px-4 py-0.5">
                                    Change
                                </button>
                            </div>
                            <div class="basis-2/3 pl-4">
                                <h1 class="text-lg font-bold">{{user.name}}</h1>
                                <h1>test@example.com</h1>
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
                <Card class=" mx-auto">
                    <CardHeader>
                        <form @submit.prevent="submitNameEmail">
                            <div>
                                <InputLabel for="name" value="Name"/>
                                <TextInput
                                    id="name"
                                    v-model="nameEmail.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="name"
                                    />
                                <InputError :message="nameEmail.errors.name" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="email" value="Email"/>
                                <TextInput
                                    id="email"
                                    v-model="nameEmail.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="name"
                                />
                                <InputError :message="nameEmail.errors.email" class="mt-2"/>
                            </div>
                            <div class="text-right mt-4">
                                <ActionMessage :on="nameEmail.recentlySuccessful" class="me-3">
                                    Saved.
                                </ActionMessage>

                                <PrimaryButton :class="{ 'opacity-25': nameEmail.processing }" :disabled="nameEmail.processing">
                                    Save
                                </PrimaryButton>
                            </div>

                        </form>
                    </CardHeader>
                </Card>

            </div>
        </Container>
    </AppLayout>
</template>
<script setup lang="ts">

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { useForm } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
const props = defineProps(['user']);

const nameEmail= useForm({
    name: props.user.name,
    email: props.user.email,
})

const submitNameEmail = () => {
    nameEmail.put(route('admin.users.update', props.user.id));
}

</script>
