<script setup lang="ts">
import { computed, ref, watch, reactive } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PublicLayout from './Components/PublicLayout.vue';
import ConfirmationModal from './Components/ConfirmationModal.vue';
import Metric from './Components/Metric.vue';
import InventoryRow from './Components/InventoryRow.vue';
import ComparisonItem from './Components/ComparisonItem.vue';
import FeatureCard from './Components/FeatureCard.vue';

defineProps<{
    contactEmail: string;
}>();

const role = ref<'advertiser' | 'publisher'>('advertiser');
const showConfirmation = ref(false);

const page = usePage();

const flashTitle = ref(page.props.flash?.successTitle || '');
const flashMessage = ref(page.props.flash?.success || '');

watch(() => page.props.flash?.success, (message) => {
    if (message) {
        flashTitle.value = page.props.flash?.successTitle || '';
        flashMessage.value = message;
        showConfirmation.value = true;
    }
}, { immediate: true });

const roleCopy = computed(() => {
    if (role.value === 'publisher') {
        return {
            headline: 'Turn premium inventory into booked campaigns faster.',
            text: 'List your available placements, approve the right advertisers, and track payouts with less manual chasing.',
        };
    }

    return {
        headline: 'Reserve premium publisher inventory before your competitors do.',
        text: 'Discover vetted inventory, compare CPMs, and launch campaigns with clearer delivery visibility.',
    };
});

function getCookie(name: string): string {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return decodeURIComponent(parts.pop()?.split(';').shift() || '');
    return '';
}

const waitlistForm = reactive({
    role: role.value,
    email: '',
    name: '',
    company: '',
    website: '',
    processing: false,
    errors: {} as Record<string, string>,
});

async function submitWaitlist(): Promise<void> {
    if (waitlistForm.processing) {
        return;
    }

    waitlistForm.processing = true;
    waitlistForm.errors = {};
    waitlistForm.role = role.value;

    try {
        const response = await fetch('/waitlist', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
            },
            body: JSON.stringify(waitlistForm)
        });

        if (!response.ok) {
            if (response.status === 422) {
                const data = await response.json();
                for (const key in data.errors) {
                    waitlistForm.errors[key] = data.errors[key][0];
                }
            }
            return;
        }

        const data = await response.json();
        flashTitle.value = data.successTitle || 'Thank you.';
        flashMessage.value = data.success || 'We received your details and will reach out soon.';
        showConfirmation.value = true;

        waitlistForm.email = '';
        waitlistForm.name = '';
        waitlistForm.company = '';
        waitlistForm.website = '';
    } catch (e) {
        console.error(e);
    } finally {
        waitlistForm.processing = false;
    }
}
</script>

<template>
    <PublicLayout>
        <ConfirmationModal
            :show="showConfirmation"
            :title="flashTitle || 'Thank you.'"
            :message="flashMessage || 'We received your details and will reach out soon.'"
            @close="showConfirmation = false"
        />

        <section id="home" class="mx-auto grid max-w-7xl gap-10 px-5 pb-16 pt-8 md:grid-cols-[1.02fr_0.98fr] md:px-8 md:pb-24 md:pt-14">
            <div class="flex flex-col justify-center">
                <h1 class="max-w-4xl text-5xl font-black leading-[1.02] tracking-[-0.055em] text-[#1c1c19] md:text-7xl">
                    Media buying without the back and forth.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-[#3f484e]">
                    An transparent marketplace where media buyers reserve forecasted ad inventory by publisher, market, format, device, and dates, while publishers approve, publish and get paid automatically as campaigns deliver.
                </p>

                <form class="mt-8 max-w-2xl border border-[#bec8cf] bg-white p-3 shadow-sm" @submit.prevent="submitWaitlist">
                    <div class="grid grid-cols-1 gap-2 min-[420px]:grid-cols-[10.5rem_minmax(0,1fr)_auto] min-[420px]:items-stretch">
                        <select v-model="role" class="w-full border border-[#bec8cf] bg-[#f6f3ee] px-3 py-2.5 text-sm font-bold outline-none focus:border-[#006386] min-[420px]:w-auto">
                            <option value="advertiser">I am an advertiser</option>
                            <option value="publisher">I am a publisher</option>
                        </select>

                        <div class="relative min-w-0 w-full">
                            <input
                                v-model="waitlistForm.email"
                                type="email"
                                placeholder="work@email.com"
                                class="w-full border border-[#bec8cf] bg-white px-3 py-2.5 text-sm text-[#1c1c19] outline-none focus:border-[#006386]"
                                :class="{ 'border-[#ed2e33]': waitlistForm.errors.email }"
                                data-lpignore="true"
                                data-1p-ignore
                            />
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-br from-[#006386] to-[#007da9] px-4 py-2.5 text-sm font-black uppercase tracking-[0.08em] text-white shadow-sm hover:brightness-105 disabled:opacity-60 min-[420px]:w-auto"
                            :disabled="waitlistForm.processing"
                        >
                            {{ waitlistForm.processing ? 'Joining...' : 'Join waitlist' }}
                        </button>
                    </div>

                    <div v-if="waitlistForm.errors.email" class="px-2 pt-2 text-sm font-semibold text-[#ed2e33]">
                        {{ waitlistForm.errors.email }}
                    </div>
                </form>

                <div class="mt-7 grid gap-3 text-sm font-semibold text-[#3f484e] sm:grid-cols-3">
                    <div class="border border-[#bec8cf] bg-white/70 p-3"><b class="text-[#1c1c19]">Launch faster</b><br />Less back-and-forth before campaigns go live.</div>
                    <div class="border border-[#bec8cf] bg-white/70 p-3"><b class="text-[#1c1c19]">Track live</b><br />Follow the full campaign journey from delivery to post-click events.</div>
                    <div class="border border-[#bec8cf] bg-white/70 p-3"><b class="text-[#1c1c19]">Transparent payments</b><br />Clear campaign spend for buyers and quicker publisher payouts.</div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -right-4 -top-4 h-48 w-48 bg-[#c3e8ff] blur-3xl"></div>
                <div class="absolute -bottom-6 -left-8 h-44 w-44 bg-[#ffbe00]/40 blur-3xl"></div>

                <div class="relative border border-[#bec8cf] bg-white p-5 shadow-xl">
                    <div class="mb-5 flex items-center justify-between gap-4">
                        <div>
                            <div class="text-[10px] font-black uppercase tracking-[0.18em] text-[#6f787f]">Marketplace preview</div>
                            <div class="text-xl font-black tracking-tight">Premium Sports Publisher</div>
                        </div>
                        <div class="text-xs font-black uppercase tracking-[0.12em] text-[#006386]">Publisher preview</div>
                    </div>

                    <div class="grid gap-3">
                        <InventoryRow market="Italy" device="Mobile" format="Interstitial · 320×480" forecast="8M / mo" cpm="$11.00" status="Available" />
                        <InventoryRow market="India" device="Desktop" format="Takeover · homepage" forecast="12M / mo" cpm="$8.50" status="Approval needed" />
                        <InventoryRow market="Brazil" device="Mobile" format="Interscroller" forecast="18M / mo" cpm="$6.20" status="Available" />
                    </div>

                    <div class="basket-live-sheen relative mt-5 overflow-hidden bg-[#f6f3ee] p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-[10px] font-black uppercase tracking-[0.18em] text-[#6f787f]">Campaign basket</div>
                                <div class="mt-1 text-2xl font-black tracking-[-0.04em] text-[#1c1c19]">$18,400 estimated</div>
                            </div>
                            <div class="text-xs font-black uppercase tracking-[0.12em] text-[#7a5800]">Pending approval</div>
                        </div>

                        <div class="mt-4 grid grid-cols-3 gap-3 text-center text-xs font-bold text-[#3f484e]">
                            <div class="bg-white p-3"><span class="block text-lg font-black text-[#006386]">3</span>placements</div>
                            <div class="bg-white p-3"><span class="block text-lg font-black text-[#006386]">38M</span>forecast</div>
                            <div class="bg-white p-3"><span class="block text-lg font-black text-[#006386]">30d</span>period</div>
                        </div>

                        <div class="mt-4 h-2 overflow-hidden bg-[#f0ede8]">
                            <div class="h-full w-[68%] bg-gradient-to-r from-[#2da8c8] to-[#006386]"></div>
                        </div>

                        <div class="mt-2 text-xs font-semibold text-[#6f787f]">Approval → Upload your creative → See your campaign live</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="problem" class="border-y border-[#bec8cf] bg-[#f6f3ee] px-5 py-14 md:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="grid gap-8 md:grid-cols-[0.95fr_1.05fr] md:items-end">
                    <div>
                        <h2 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">The deal is not hard. The process is broken.</h2>
                        <p class="mt-4 text-lg leading-8 text-[#3f484e]">
                            Every campaign still depends on manual inventory checks, insertion orders, creative approval, tracking links, reporting, invoicing, and renewal chasing.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <Metric label="Time-to-live" value="1–2 mo" note="From first interest to live campaign." accent="#e83a91" />
                        <Metric label="Contract cycle" value="2–4 wk" note="Insertion orders and negotiation." accent="#ffbe00" />
                        <Metric label="Reporting delay" value="Weekly" note="Stats pulled and emailed manually." accent="#006386" />
                    </div>
                </div>

                <div class="mt-10 w-full border border-[#bec8cf] bg-white px-5 shadow-sm md:px-7">
                    <ComparisonItem title="Inventory discovery" before="Manual availability checks across publishers, markets, and formats." after="Structured inventory with forecasts, CPMs, devices, and dates." />
                    <ComparisonItem title="Approval & booking" before="Negotiation, contracts, approval chasing, and payment coordination." after="Inventory requests, publisher approval, and clear campaign terms." />
                    <ComparisonItem title="Creative & tracking" before="Creative issues and tracking links delay launch." after="Creative upload, file requirements, and tracking links handled in one flow." />
                    <ComparisonItem title="Reporting & renewal" before="Delayed reports make renewals harder." after="Live campaign journey: delivery, clicks, CTR, registrations, events, and pacing." />
                    <ComparisonItem title="Publisher payment" before="Manual invoices and payment follow-ups." after="Publisher earnings accrue automatically and payouts are easier to track." />
                </div>
            </div>
        </section>

        <section id="marketplace" class="mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-24">
            <div class="max-w-3xl">
                <h2 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">A controlled marketplace for premium publisher inventory.</h2>
                <p class="mt-4 text-lg leading-8 text-[#3f484e]">
                    Media buyers get a faster way to buy media. Publishers get a cleaner way to sell inventory, approve brands, publish campaigns, and collect payment.
                </p>
            </div>

            <div class="mt-10 grid gap-4 md:grid-cols-2">
                <FeatureCard
                    title="For advertisers"
                    text="Buy media by the variables that actually matter: approved markets, device, format, price, campaign dates, budget, and performance visibility."
                    :bullets="[
                        'Browse CPMs by publisher, market, format, device, and ad slot',
                        'Set campaign start and end dates, budget, and preview the booking before submitting',
                        'Track campaign journey from delivery to clicks, CTR, registrations, and events',
                        'Keep campaigns aligned with approved markets and suitable publisher sections',
                    ]"
                />

                <FeatureCard
                    title="For publishers"
                    text="Turn forecasted inventory into a structured sales channel while keeping control over who can buy, what goes live, and when you get paid."
                    :bullets="[
                        'Set floor CPMs by market, format, slot, device, and minimum booking term',
                        'Approve or reject advertisers based on relationships, verticals, and internal rules',
                        'Receive creatives, tracking links, and campaign details in one workflow',
                        'Track accrued earnings and get paid with clearer payout visibility',
                    ]"
                />
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-5 pb-16 md:px-8 md:pb-24">
            <div class="border border-[#bec8cf] bg-white p-6 shadow-sm md:p-8">
                <div class="grid gap-8 md:grid-cols-[0.9fr_1.1fr] md:items-center">
                    <div>
                        <h2 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">Speed gets campaigns live. Proof gets them renewed.</h2>
                        <p class="mt-4 text-lg leading-8 text-[#3f484e]">
                            Media buyers need confidence before they renew. Publishers need control before they scale. The marketplace gives both sides a clearer path from request to launch, delivery, and payout.
                        </p>
                    </div>

                    <div class="grid gap-3">
                        <div class="bg-[#f6f3ee] p-5">
                            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">Before</div>
                            <div class="mt-2 text-xl font-black text-[#1c1c19]">Email threads, spreadsheets, invoices, delayed stats, and unclear renewal decisions.</div>
                        </div>

                        <div class="bg-[#c3e8ff] p-5">
                            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#004f6e]/70">After</div>
                            <div class="mt-2 text-xl font-black text-[#004f6e]">A guided campaign workflow with live reporting, publisher approval, creative upload, and clearer payout reconciliation.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="waitlist" class="bg-[#f6f3ee] px-5 py-16 md:px-8 md:py-20">
            <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-[1fr_0.82fr] md:items-center">
                <div>
                    <h2 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">{{ roleCopy.headline }}</h2>
                    <p class="mt-4 max-w-2xl text-lg leading-8 text-[#3f484e]">{{ roleCopy.text }}</p>
                </div>

                <form class="border border-[#bec8cf] bg-white p-4 shadow-sm" @submit.prevent="submitWaitlist">
                    <div class="grid grid-cols-1 gap-2 min-[420px]:grid-cols-[10.5rem_minmax(0,1fr)_auto] min-[420px]:items-stretch">
                        <select v-model="role" class="w-full border border-[#bec8cf] bg-[#f6f3ee] px-3 py-2.5 text-sm font-bold text-[#1c1c19] outline-none focus:border-[#006386] min-[420px]:w-auto">
                            <option value="advertiser">I am an advertiser</option>
                            <option value="publisher">I am a publisher</option>
                        </select>

                        <div class="relative min-w-0 w-full">
                            <input
                                v-model="waitlistForm.email"
                                type="email"
                                placeholder="work@email.com"
                                class="w-full border border-[#bec8cf] bg-white px-3 py-2.5 text-sm text-[#1c1c19] outline-none focus:border-[#006386]"
                                :class="{ 'border-[#ed2e33]': waitlistForm.errors.email }"
                                data-lpignore="true"
                                data-1p-ignore
                            />
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-br from-[#006386] to-[#007da9] px-4 py-2.5 text-sm font-black uppercase tracking-[0.08em] text-white shadow-sm hover:brightness-105 disabled:opacity-60 min-[420px]:w-auto"
                            :disabled="waitlistForm.processing"
                        >
                            {{ waitlistForm.processing ? 'Joining...' : 'Join waitlist' }}
                        </button>
                    </div>

                    <div v-if="waitlistForm.errors.email" class="mt-2 text-sm font-semibold text-[#ed2e33]">
                        {{ waitlistForm.errors.email }}
                    </div>

                    <p class="mt-3 text-xs leading-5 text-[#6f787f]">Join early to help shape the first version, access curated supply or demand sooner, and be first in line when onboarding opens.</p>
                </form>
            </div>
        </section>
    </PublicLayout>
</template>

<style scoped>
.basket-live-sheen::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    background: linear-gradient(
        102deg,
        transparent 0%,
        rgba(0, 99, 134, 0.06) 48%,
        rgba(0, 99, 134, 0.09) 50%,
        rgba(0, 99, 134, 0.06) 52%,
        transparent 100%
    );
    background-size: 220% 100%;
    animation: basket-shine 7.5s ease-in-out infinite;
}

.basket-live-sheen > * {
    position: relative;
    z-index: 1;
}
</style>
