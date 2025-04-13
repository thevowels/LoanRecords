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

                            </div>
                            <div class="mx-auto">
                                {{formatDistance(user.created_at, new Date(),{addSuffix: true})}}
                            </div>
                        </div>
                    </CardHeader>
                </Card>
                <div v-if="user.limits.length < 2" class="text-right">
                    <PrimaryButton v-if="!add" @click="() => add = !add">
                        Add Limit
                    </PrimaryButton>
                </div>
                <Card v-if="add">
                    <CardHeader>
                        <form @submit.prevent="addLimit" class="mx-auto" >
                            <div>
                                <InputLabel for="currency">currency</InputLabel>
                                <select id="currency" v-model="limitForm.currency" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-w-44">
                                    <option v-for="currency in Currencies" :key="currency" :value="currency">{{currency}}</option>
                                </select>
                            </div>
                            <div>
                                <InputLabel for="limit" value="Limit"/>
                                <TextInput type="number"
                                           v-model="limitForm.limit"
                                           class="mt-2 w-48 mx-auto"
                                           />
                                <InputError :message="limitForm.errors.limit" class="mt-2"/>
                            </div>
                            <div class="text-right mt-2">
                                <PrimaryButton>Add</PrimaryButton>
                            </div>
                        </form>
                    </CardHeader>
                </Card>
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
import { formatDistance} from "date-fns";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {route} from "ziggy-js";
import UserLimit from "@/Components/User/UserLimit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
const add = ref(false);
const props = defineProps(["user"])
let Currencies = ['kyat', 'baht'];


props.user.limits.forEach((limit) => {  Currencies = Currencies.filter(x => x!= limit.currency)})

console.log(Currencies);
const limitForm = useForm({
    'user_id' : props.user.id,
    'currency': '',
    'limit' : '',
})

const addLimit = () => {
    console.log(limitForm);
    limitForm.post(route('admin.users.addLimit', props.user.id), {
        onSuccess: () => {
            limitForm.reset();
            add.value = false;
        }
    });
}
const goTo = (id: string) => {
    window.location.href = route('admin.users.edit', id);
}

</script>
