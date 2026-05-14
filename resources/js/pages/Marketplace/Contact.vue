<script setup lang="ts">
import { ref, watch, reactive } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PublicLayout from './Components/PublicLayout.vue';
import ConfirmationModal from './Components/ConfirmationModal.vue';

defineProps<{
    contactEmail: string;
}>();

const page = usePage();
const showConfirmation = ref(false);

const flashTitle = ref(page.props.flash?.successTitle || '');
const flashMessage = ref(page.props.flash?.success || '');

watch(
    () => page.props.flash?.success,
    (message) => {
        if (message) {
            flashTitle.value = page.props.flash?.successTitle || '';
            flashMessage.value = message;
            showConfirmation.value = true;
        }
    },
    { immediate: true },
);

function getCookie(name: string): string {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return decodeURIComponent(parts.pop()?.split(';').shift() || '');
    return '';
}

const form = reactive({
    role: 'advertiser',
    name: '',
    email: '',
    company: '',
    website: '',
    message: '',
    processing: false,
    errors: {} as Record<string, string>,
});

async function submitContact(): Promise<void> {
    if (form.processing) {
        return;
    }

    form.processing = true;
    form.errors = {};

    try {
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
            },
            body: JSON.stringify(form)
        });

        if (!response.ok) {
            if (response.status === 422) {
                const data = await response.json();
                for (const key in data.errors) {
                    form.errors[key] = data.errors[key][0];
                }
            }
            return;
        }

        const data = await response.json();
        flashTitle.value = data.successTitle || 'Thank you for contacting us.';
        flashMessage.value = data.success || 'We received your message and will reach out to you very soon.';
        showConfirmation.value = true;

        form.name = '';
        form.email = '';
        form.company = '';
        form.website = '';
        form.message = '';
    } catch (e) {
        console.error(e);
    } finally {
        form.processing = false;
    }
}
</script>

<template>
    <PublicLayout>
        <ConfirmationModal
            :show="showConfirmation"
            :title="flashTitle || 'Thank you for contacting us.'"
            :message="flashMessage || 'We received your message and will reach out to you very soon.'"
            @close="showConfirmation = false"
        />

        <section class="mx-auto max-w-4xl px-5 py-12 md:px-8">
            <div class="grid gap-5 md:grid-cols-[0.9fr_1.1fr]">
                <div class="border border-[#bec8cf] bg-white p-6 shadow-sm md:p-8">
                    <h1 class="text-4xl font-black tracking-[-0.04em]">Contact</h1>
                    <p class="mt-4 text-sm leading-7 text-[#3f484e]">Tell us whether you are a publisher or media buyer, what markets you care about, and what kind of campaign or inventory you want to discuss.</p>
                    <div class="mt-8 border-t border-[#bec8cf] pt-5 text-sm leading-7 text-[#3f484e]">
                        <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">Email</div>
                        <a class="font-black text-[#006386]" :href="`mailto:${contactEmail}`">{{ contactEmail }}</a>
                    </div>
                </div>

                <form class="border border-[#bec8cf] bg-white p-6 shadow-sm md:p-8" @submit.prevent="submitContact">
                    <div class="grid gap-4">
                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            Name
                            <input v-model="form.name" class="border border-[#bec8cf] px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]" placeholder="Your name" />
                            <span v-if="form.errors.name" class="text-xs normal-case tracking-normal text-[#ed2e33]">{{ form.errors.name }}</span>
                        </label>

                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            Email
                            <input v-model="form.email" type="email" class="border border-[#bec8cf] px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]" placeholder="work@email.com" />
                            <span v-if="form.errors.email" class="text-xs normal-case tracking-normal text-[#ed2e33]">{{ form.errors.email }}</span>
                        </label>

                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            I am a
                            <select v-model="form.role" class="border border-[#bec8cf] bg-white px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]">
                                <option value="advertiser">Media buyer / advertiser</option>
                                <option value="publisher">Publisher</option>
                                <option value="agency">Agency</option>
                                <option value="other">Other</option>
                            </select>
                        </label>

                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            Company
                            <input v-model="form.company" class="border border-[#bec8cf] px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]" placeholder="Company name" />
                        </label>

                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            Website
                            <input v-model="form.website" class="border border-[#bec8cf] px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]" placeholder="https://example.com" />
                            <span v-if="form.errors.website" class="text-xs normal-case tracking-normal text-[#ed2e33]">{{ form.errors.website }}</span>
                        </label>

                        <label class="grid gap-2 text-xs font-black uppercase tracking-[0.14em] text-[#6f787f]">
                            Message
                            <textarea v-model="form.message" rows="5" class="border border-[#bec8cf] px-4 py-3 text-sm font-medium normal-case tracking-normal text-[#1c1c19] outline-none focus:border-[#006386]" placeholder="Tell us what you want to buy, sell, or explore." />
                            <span v-if="form.errors.message" class="text-xs normal-case tracking-normal text-[#ed2e33]">{{ form.errors.message }}</span>
                        </label>

                        <button
                            type="submit"
                            class="bg-gradient-to-br from-[#006386] to-[#007da9] px-6 py-4 text-sm font-black uppercase tracking-[0.08em] text-white shadow-sm hover:brightness-105 disabled:opacity-60"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? 'Sending...' : 'Send message' }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </PublicLayout>
</template>
