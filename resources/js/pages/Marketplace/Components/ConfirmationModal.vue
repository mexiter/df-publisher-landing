<script setup lang="ts">
defineProps<{
    show: boolean;
    title: string;
    message: string;
}>();

const emit = defineEmits<{
    close: [];
}>();
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-[80] grid place-items-center bg-[#1c1c19]/40 px-5 backdrop-blur-sm">
        <div class="w-full max-w-md border border-[#bec8cf] bg-white p-6 shadow-2xl">
            <div class="mb-5 grid h-12 w-12 place-items-center bg-[#d4f1de] text-xl font-black text-[#1f6a3a]">✓</div>
            <h2 class="text-2xl font-black tracking-[-0.03em] text-[#1c1c19]">{{ title }}</h2>
            <p class="mt-3 text-sm leading-6 text-[#3f484e]">{{ message }}</p>
            <button
                type="button"
                class="mt-6 w-full bg-gradient-to-br from-[#006386] to-[#007da9] px-5 py-3 text-sm font-black uppercase tracking-[0.08em] text-white"
                @click="emit('close')"
            >
                Close
            </button>
        </div>
    </div>
</template>
