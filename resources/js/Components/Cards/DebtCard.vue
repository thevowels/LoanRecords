<template>
    <Card class="flex flex-col w-fit " >
        <Link   :href="route('debts.show', account.id)" class=" py-3 px-4">
            <div class="flex flex-row space-x-4">
                <div>
                    <p>Currency {{account.currency}}</p>
                    <p>Current: {{account.balance}}</p>
                    <p>Limit  : {{account.limit}}</p>
                </div>
                <div>
                    <Pie class="w-16" :data="pieData" :options="options"/>
                </div>

            </div>
        </Link>

    </Card>

</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {Card} from "@/components/ui/card/index.js";

import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import {computed} from "vue";
ChartJS.register(ArcElement, Tooltip, Legend)

const props =defineProps({
    account: {
        type: Object,
        required: true,
    }
});
const pieData = computed(() => ({

    labels: ['Current Loan', 'Available'],
    datasets : [
        {
            backgroundColor:[ '#ff3131', '#35EC0B',],
            data: [props.account.balance, props.account.limit - props.account.balance, ]
        }
    ]

}))


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
        },
        legend: {
            display: false
        }
    }
}

</script>
