<script setup lang="ts">
defineProps<{
    title: string;
    text: string;
    bullets: string[];
}>();
</script>

<template>
    <div class="border border-[#bec8cf] bg-white p-7 shadow-sm">
        <h3 class="text-2xl font-black tracking-[-0.03em] text-[#1c1c19]">{{ title }}</h3>
        <p class="mt-3 text-sm leading-6 text-[#3f484e]">{{ text }}</p>

        <div class="mt-6 grid gap-4">
            <div v-for="bullet in bullets" :key="bullet" class="grid grid-cols-[18px_1fr] gap-3 text-sm font-semibold leading-6 text-[#3f484e]">
                <span class="mt-2 h-1.5 w-1.5 bg-[#006386]" />
                <span>{{ bullet }}</span>
            </div>
        </div>
    </div>
</template>
