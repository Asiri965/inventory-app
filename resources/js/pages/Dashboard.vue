<script setup>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        </template>
        <!-- Quick Actions FAB -->
        <div class="fixed right-8 bottom-8 flex flex-col gap-3">
            <Link
                :href="route('inventory.add')"
                class="flex h-14 w-14 transform items-center justify-center rounded-full bg-green-600 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-green-700 hover:shadow-xl"
                title="Add Stock"
                tooltip="Add Stock"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 11l5-5m0 0l5 5m-5-5v12"
                    />
                </svg>
            </Link>
            <Link
                :href="route('inventory.deduct')"
                class="flex h-14 w-14 transform items-center justify-center rounded-full bg-orange-500 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-orange-600 hover:shadow-xl"
                title="Deduct Stock"
                tooltip="Deduct Stock"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 13l-5 5m0 0l-5-5m5 5V6"
                    />
                </svg>
            </Link>

            <!-- <Link
                :href="route('inventory.create')"
                class="flex h-14 w-14 transform items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-indigo-700 hover:shadow-xl"
                title="Add Items"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>
            </Link> -->
        </div>
    </AuthenticatedLayout>
</template>
