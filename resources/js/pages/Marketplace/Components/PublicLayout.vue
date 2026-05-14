<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import logoUrl from '../../../../images/dataflair-logo.svg?url';
</script>

<template>
    <main class="min-h-screen bg-[#fcf9f3] text-[#1c1c19]">
        <header class="sticky top-0 z-50 border-b border-[#bec8cf] bg-white/95 px-5 py-4 shadow-sm backdrop-blur md:px-8">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        :src="logoUrl"
                        alt="DataFlair"
                        class="h-10 w-auto shrink-0 object-contain md:h-[calc(var(--spacing)*7)]"
                        width="132"
                        height="44"
                        decoding="async"
                    />
                    <div class="min-w-0">
                        <div class="text-sm font-extrabold tracking-tight">DataFlair</div>
                        <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#6f787f]">Publisher Marketplace</div>
                    </div>
                </Link>

                <nav class="hidden items-center gap-7 text-sm font-semibold text-[#3f484e] md:flex">
                    <Link href="/" class="hover:text-[#006386]">Home</Link>
                    <a href="/#marketplace" class="hover:text-[#006386]">Marketplace</a>
                    <Link href="/contact" class="hover:text-[#006386]">Contact</Link>
                    <a href="/#waitlist" class="bg-[#006386] px-5 py-2 text-white shadow-sm hover:bg-[#004f6e]">Join waitlist</a>
                </nav>
            </div>
        </header>

        <slot />

        <footer class="border-t border-[#bec8cf] bg-white px-5 py-8 md:px-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 text-sm text-[#6f787f] md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-3">
                    <img
                        :src="logoUrl"
                        alt=""
                        class="h-10 w-auto shrink-0 self-center object-contain md:h-[calc(var(--spacing)*7)]"
                        width="132"
                        height="44"
                        decoding="async"
                        role="presentation"
                    />
                    <div class="min-w-0">
                        <div class="font-black text-[#1c1c19]">DataFlair Publisher Marketplace</div>
                        <div class="mt-0 text-xs">Connecting publishers and media buyers.</div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-5 text-xs font-bold uppercase tracking-[0.12em]">
                    <Link href="/privacy-policy" class="hover:text-[#006386]">Privacy Policy</Link>
                    <Link href="/terms" class="hover:text-[#006386]">Terms</Link>
                    <Link href="/publisher-terms" class="hover:text-[#006386]">Publisher Terms</Link>
                    <Link href="/contact" class="hover:text-[#006386]">Contact</Link>
                </div>
            </div>
        </footer>
    </main>
</template>
