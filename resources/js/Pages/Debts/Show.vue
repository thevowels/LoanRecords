<template>
    <AppLayout :title="account.currency.toUpperCase() + ' - '+  person.name ">
        <Container>
            <div class="flex flex-col md:flex-row">
                <div class="flex-1 text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-600 ">{{person.name}}</h1>
                    <h1>{{person.phone}}</h1>
                    <div class="text-lg font-bold text-gray-900">
                        <p>Max Loan Limit <span>{{account.limit}}</span> </p>
                        <p>Current Loan <span>{{account.balance}} </span> </p>
                    </div>
                </div>
                <div class="flex-1">
                    <Card class="max-w-[350px] mx-auto">
                        <CardHeader>
                            <CardTitle>Active Loan</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div>
                                <Pie :data="pieData" :options="options"/>
                            </div>
                        </CardContent>
                        <CardFooter>
                        </CardFooter>
                    </Card>
                </div>
            </div>
        </Container>

    </AppLayout>

</template>

<script setup>


import AppLayout from "@/Layouts/AppLayout.vue";

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            usePointStyle: true,
            callbacks: {
                afterLabel: function (context) {
                    return props.account.currencyCode
                },
            }
        }
    }
}
const pieData = computed(() => ({

    labels: ['Current Loan', 'Available'],
    datasets : [
        {
            backgroundColor:[ '#ff3131', '#35EC0B',],
            data: [props.account.balance, props.account.limit - props.account.balance, ]
        }
    ]

}))
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
ChartJS.register(ArcElement, Tooltip, Legend)

console.log(pieData);

import { Progress } from '@/components/ui/progress'
import {computed} from "vue";
import Container from "@/Components/Container.vue";
const props = defineProps(['account', 'person'])
</script>
