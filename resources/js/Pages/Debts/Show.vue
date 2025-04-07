<template>
    <AppLayout :title="account.currency.toUpperCase() + ' - '+  person.name ">

        <div>
            <div class="text-center text-xl text-blue-500">
                {{account.currency.toUpperCase()}} account for {{person.name}}
            </div>
            {{person.name}}
        </div>

    </AppLayout>

</template>

<script setup>


import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(['account', 'person'])
</script>
