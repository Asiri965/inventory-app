<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col bg-[#e8f8ff] p-6 pb-24 text-[#1b1b18] lg:p-8"
    >
        <header class="mb-6 w-full text-sm not-has-[nav]:hidden lg:mb-14">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035]"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full flex-col-reverse overflow-hidden rounded-lg lg:max-w-7xl lg:flex-row"
            >
                <div
                    class="items-center justify-center rounded-br-lg rounded-bl-lg p-6 pb-12 text-[13px] leading-[20px] lg:p-10 lg:pt-20"
                >
                    <span
                        data-aos="fade-right"
                        data-aos-once="true"
                        class="text-gradient text-base font-semibold uppercase"
                        >Sign Up Today</span
                    >
                    <h1
                        class="text-[2.5rem] leading-tight font-bold capitalize sm:pr-8 sm:text-5xl xl:pr-10 xl:text-6xl"
                    >
                        <span class="text-header-gradient">Simple</span>
                        Inventory Web App
                    </h1>
                    <p
                        data-aos="fade-down"
                        data-aos-once="true"
                        data-aos-delay="300"
                        class="paragraph hidden text-base leading-relaxed text-[#444444] sm:block sm:pr-8 xl:pr-10"
                    >
                        Track your stock, manage products, and stay in control —
                        all in one easy dashboard.
                    </p>
                    <ul
                        class="text-body my-6 flex max-w-full list-inside space-y-1 lg:flex-row"
                    >
                        <li
                            class="mr-6 flex items-center space-x-3 rtl:space-x-reverse"
                        >
                            <svg
                                class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>
                            Add Products
                        </li>
                        <li
                            class="mr-6 flex items-center space-x-3 rtl:space-x-reverse"
                        >
                            <svg
                                class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>
                            Track Stock
                        </li>
                    </ul>
                    <div
                        data-aos="fade-up"
                        data-aos-once="true"
                        data-aos-delay="700"
                        class="mt-3 flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4"
                    >
                        <button
                            class="mt-2 max-w-full rounded-full border border-[#0c66ee] bg-gradient-to-r from-[#468ef9] to-[#0c66ee] px-8 py-4 text-center text-sm text-white transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                    </div>
                </div>
            </main>
        </div>
        <!-- Partner Section -->
        <section
            class="bg-partner relative max-w-full overflow-hidden shadow sm:mx-6 sm:rounded-2xl"
        >
            <div
                class="flex w-full flex-col items-center justify-center space-y-4 px-6 py-16 text-center sm:px-0"
            >
                <h3
                    data-aos="flip-down"
                    class="text-2xl font-semibold text-neutral-800"
                >
                    Trusted by Businesses in Sri Lanka
                </h3>
                <p data-aos="flip-down" class="paragraph">
                    Used by small and medium businesses to manage inventory
                    faster, reduce losses, and improve daily operations.
                </p>
                <div data-aos="fade-up" class="flex flex-wrap">
                    <div>
                        <img
                            src="img/partner/clever.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Clever Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/diamond-cutts.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Diamond Cutts Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/gambio.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Gambio Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/swiss-finance.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Swiss Finance Partner Logo"
                        />
                    </div>
                </div>
            </div>
        </section>
        <!-- Advanced trading tools section -->
        <section
            class="bg-trading-tools relative my-10 max-w-full overflow-hidden rounded-2xl py-16 shadow sm:mx-4"
        >
            <div
                class="relative mx-auto grid max-w-screen-xl grid-cols-12 gap-x-6 px-4 sm:px-2"
            >
                <div
                    data-aos="fade-right"
                    class="col-span-12 mt-8 space-y-8 px-4 sm:space-y-6 sm:px-6 lg:col-span-6"
                >
                    <h2 class="text-4xl font-semibold">
                        Inventory Management
                        <span class="text-header-gradient">Tools</span>
                    </h2>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">
                            Powerful Inventory Tools
                        </h4>
                        <p class="paragraph text-sm xl:text-base">
                            Everything you need to manage stock easily — no
                            complicated systems.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">Product Management</h4>
                        <p class="paragraph text-sm xl:text-base">
                            Create and organize items with SKU, category, price,
                            supplier, and stock quantity.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">
                            Stock In / Stock Out Tracking
                        </h4>
                        <p class="paragraph text-sm xl:text-base">
                            Update inventory instantly when items are received
                            or sold.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">Low Stock Alerts</h4>
                        <p class="paragraph text-sm xl:text-base">
                            Get notified when an item is running low so you
                            never run out unexpectedly.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">Reports & Export</h4>
                        <p class="paragraph text-sm xl:text-base">
                            Generate stock reports and export to Excel or PDF
                            whenever needed.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">Multi-User Access</h4>
                        <p class="paragraph text-sm xl:text-base">
                            Allow staff members to use the system with
                            role-based permissions.
                        </p>
                    </div>
                    <!-- <div class="flex flex-col sm:flex-row">
                        <button
                            class="text-gradient rounded-full border border-[#4A8FF6] bg-inherit px-10 py-4 text-center text-base text-sm transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                        <button
                            class="rounded-full bg-inherit px-10 py-4 text-center text-sm text-[#4A8FF6] underline transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                    </div> -->
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="w-full sm:mt-20 xl:mt-0">
                        <img
                            src="img/advanced-trading-tools.webp"
                            class="w-full"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Industry-leading security section -->
        <section class="my-5 w-full">
            <div
                class="relative mx-auto grid max-w-screen-xl grid-cols-12 gap-x-6 px-8"
            >
                <div data-aos="fade-right" class="col-span-12 lg:col-span-6">
                    <div class="w-full">
                        <img
                            src="/img/industry-leading-security.webp"
                            class="w-full"
                            alt=""
                        />
                    </div>
                </div>
                <div
                    data-aos="fade-left"
                    class="col-span-12 mt-8 space-y-8 sm:space-y-6 lg:col-span-5 xl:px-8"
                >
                    <h2 class="text-4xl font-semibold">
                        Designed for Speed and Simplicity
                    </h2>
                    <p>
                        Our system is built to be beginner-friendly but powerful
                        enough for business use.
                    </p>
                    <ul class="space-y-8 sm:space-y-4">
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg
                                    class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                                <span>Easy to use dashboard </span>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg
                                    class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                                <span
                                    >Works on laptop, mobile, and tablet
                                </span>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg
                                    class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                                <span>Secure login & protected data</span>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg
                                    class="text-fg-success me-1.5 h-4 w-4 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                                <span>Fast setup and quick training</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Advanced trading tools section -->
        <!-- <section
            class="bg-partner relative max-w-full overflow-hidden shadow sm:mx-6 sm:rounded-2xl"
        >
            <div
                class="flex w-full flex-col items-center justify-center space-y-4 px-6 py-16 text-center sm:px-0"
            > -->
        <section
            class="bg-trading-tools max-w-full overflow-hidden rounded-2xl bg-[#4A8FF6] py-16 shadow sm:mx-4"
        >
            <div
                class="flex w-full flex-col items-center justify-center space-y-4 px-6 py-16 text-center sm:px-0"
            >
                <div
                    data-aos="fade-right"
                    class="col-span-12 mt-8 space-y-8 px-4 text-center sm:space-y-6 sm:px-6 lg:col-span-6"
                >
                    <h2 class="text-4xl font-semibold">
                        Start Managing Inventory the
                        <span class="text-header-gradient">Smart Way</span>
                    </h2>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">
                            Stop using notebooks and messy spreadsheets. Move
                            your inventory to a simple online system today.
                        </h4>
                    </div>
                    <div class="flex w-full items-center justify-center">
                        <button
                            class="text-gradient mr-5 rounded-full border border-[#4A8FF6] bg-[#4A8FF6] px-10 py-4 text-center text-base text-sm text-white transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Request a Demo
                        </button>
                        <button
                            class="text-gradient rounded-full border border-[#4A8FF6] bg-inherit px-10 py-4 text-center text-base text-sm transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact Our Team
                        </button>
                    </div>
                </div>

                <!-- <div class="col-span-12 lg:col-span-6">
                    <div class="w-full sm:mt-20 xl:mt-0">
                        <img
                            src="img/advanced-trading-tools.webp"
                            class="w-full"
                            alt=""
                        />
                    </div>
                </div> -->
            </div>
        </section>
        <footer class="mx-auto mt-auto w-full max-w-screen-xl px-2">
            <div class="w-full border-y border-[#DDDDDD]"></div>
            <div
                class="text-center text-sm text-[#666666] hover:text-gray-900 sm:py-4"
            >
                &copy; Copyright 2025 Mentra Labs. All rights reserved
            </div>
        </footer>
    </div>
</template>
<style scoped>
.text-header-gradient {
    background: rgb(57, 132, 244);
    background: linear-gradient(
        169.4deg,
        #3984f4 -6.01%,
        #0cd3ff 36.87%,
        #2f7cf0 78.04%,
        #0e65e8 103.77%
    );
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.bg-partner {
    background: url('/img/partner/background.png');
    background-size: cover;
    background-position: center;
}
.bg-trading-tools {
    background: url('./img/bg-trading-tools.webp');
    background-size: cover;
    background-position: center;
}
.max-h-0 {
    max-height: 0;
}
</style>
