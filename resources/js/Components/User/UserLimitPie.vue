<template>

    <slot name="header"/>
    <Pie :data="data" :options="options" class="max-w-sm mx-auto" />
</template>

<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'
import {computed} from "vue";

ChartJS.register(ArcElement, Tooltip, Legend);

const options = {
    responsive: true,
    maintainAspectRatio: true
}
const props = defineProps(['userLimit']);

const data = {
        labels: ['User Limit', 'Used Amount'],
        datasets: [
            {
                backgroundColor: ['#41B883', '#E46651'],
                data: [props.userLimit.limit, props.userLimit.usedAmount]
            }
        ]
    };


</script>
