<script setup lang="ts">
defineProps<{
    market: string;
    device: string;
    format: string;
    forecast: string;
    cpm: string;
    status: string;
}>();
</script>

<template>
    <div class="grid gap-3 border border-[#bec8cf] bg-white p-4 md:grid-cols-[1.2fr_0.8fr_0.8fr_0.7fr] md:items-center">
        <div>
            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">{{ market }} · {{ device }}</div>
            <div class="mt-1 text-sm font-black text-[#1c1c19]">{{ format }}</div>
        </div>
        <div>
            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">Forecast</div>
            <div class="mt-1 text-sm font-black text-[#1c1c19]">{{ forecast }}</div>
        </div>
        <div>
            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">CPM</div>
            <div class="mt-1 text-sm font-black text-[#006386]">{{ cpm }}</div>
        </div>
        <div class="text-xs font-black uppercase tracking-[0.1em]" :class="status === 'Available' ? 'text-[#1f6a3a]' : 'text-[#7a5800]'">
            {{ status }}
        </div>
    </div>
</template>
