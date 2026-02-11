<script setup>
import Card from '@/components/Card.vue';
import StatCard from '@/components/StatCard.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object,
    lowStockItems: Array,
    recentTransactions: Array,
});

const formatQuantity = (quantity) => {
    const num = parseFloat(quantity);
    return num % 1 === 0 ? num.toFixed(0) : num.toFixed(2);
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const getTimeAgo = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return `${diffMins}m ago`;
    if (diffHours < 24) return `${diffHours}h ago`;
    return `${diffDays}d ago`;
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        </template>

        <!-- Stats Grid -->
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Items -->
            <StatCard
                title="Total Items"
                :value="stats.totalItems"
                color="indigo"
            >
                <template #icon>
                    <svg
                        class="h-8 w-8 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />
                    </svg>
                </template>
            </StatCard>

            <!-- Total Stock -->
            <StatCard
                title="Total Stock"
                :value="parseFloat(stats.totalStock)"
                color="teal"
            >
                <template #icon>
                    <svg
                        class="h-8 w-8 text-teal-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"
                        />
                    </svg>
                </template>
            </StatCard>

            <!-- Low Stock Alert -->
            <StatCard
                title="Low Stock"
                :value="stats.lowStockCount"
                color="orange"
            >
                <template #icon>
                    <svg
                        class="h-8 w-8 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                </template>
            </StatCard>

            <!-- Out of Stock -->
            <StatCard
                title="Out of Stock"
                :value="stats.outOfStockCount"
                color="red"
            >
                <template #icon>
                    <svg
                        class="h-8 w-8 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                        />
                    </svg>
                </template>
            </StatCard>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Low Stock Items -->
            <Card>
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Low Stock Items
                    </h2>
                    <Link
                        :href="route('items.index')"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                    >
                        View All
                    </Link>
                </div>

                <div v-if="lowStockItems.length === 0" class="py-8 text-center">
                    <svg
                        class="mx-auto mb-3 h-12 w-12 text-green-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <p class="text-gray-500">All items are well stocked!</p>
                </div>

                <div v-else class="space-y-4">
                    <div
                        v-for="item in lowStockItems"
                        :key="item.id"
                        class="flex items-center justify-between rounded-lg border border-orange-100 bg-orange-50 p-4"
                    >
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100"
                            >
                                <svg
                                    class="h-5 w-5 text-orange-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <Link
                                    :href="route('items.show', item.id)"
                                    class="font-medium text-gray-900 hover:text-indigo-600"
                                >
                                    {{ item.name }}
                                </Link>
                                <p class="text-sm text-gray-500">
                                    {{ item.unit?.name }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-bold text-orange-600">
                                {{ formatQuantity(item.quantity) }}
                            </span>
                            <span class="ml-1 text-sm text-gray-500">{{
                                item.unit?.abbreviation
                            }}</span>
                        </div>
                    </div>
                </div>
            </Card>

            <!-- Recent Transactions -->
            <Card>
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Recent Activity
                    </h2>
                    <span class="text-sm text-gray-500">
                        {{ stats.todayTransactions }} today
                    </span>
                </div>

                <div v-if="recentTransactions" class="flow-root">
                    <ul class="-mb-8">
                        <li
                            v-for="(transaction, index) in recentTransactions"
                            :key="transaction.id"
                        >
                            <div class="relative pb-8">
                                <!-- Timeline connector -->
                                <span
                                    v-if="
                                        index !== recentTransactions.length - 1
                                    "
                                    class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                />

                                <div
                                    class="relative flex items-start space-x-4"
                                >
                                    <!-- Icon -->
                                    <div
                                        class="relative flex h-10 w-10 items-center justify-center rounded-full"
                                        :class="
                                            transaction.type === 'add'
                                                ? 'bg-green-100'
                                                : 'bg-red-100'
                                        "
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            :class="
                                                transaction.type === 'add'
                                                    ? 'text-green-600'
                                                    : 'text-red-600'
                                            "
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                v-if="
                                                    transaction.type === 'add'
                                                "
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12"
                                            />
                                            <path
                                                v-else
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                            />
                                        </svg>
                                    </div>

                                    <!-- Content -->
                                    <div class="min-w-0 flex-1">
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'items.show',
                                                            transaction.item
                                                                ?.id,
                                                        )
                                                    "
                                                    class="hover:text-indigo-600"
                                                >
                                                    {{
                                                        transaction.item
                                                            ?.name ||
                                                        'Unknown Item'
                                                    }}
                                                </Link>
                                            </p>
                                            <span class="text-xs text-gray-500">
                                                {{
                                                    getTimeAgo(
                                                        transaction.created_at,
                                                    )
                                                }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500">
                                            <span
                                                :class="
                                                    transaction.type === 'add'
                                                        ? 'text-green-600'
                                                        : 'text-red-600'
                                                "
                                                class="font-medium"
                                            >
                                                {{
                                                    transaction.type === 'add'
                                                        ? '+'
                                                        : '-'
                                                }}{{
                                                    formatQuantity(
                                                        transaction.quantity,
                                                    )
                                                }}
                                            </span>
                                            <span
                                                v-if="transaction.notes"
                                                class="ml-2"
                                                >- {{ transaction.notes }}</span
                                            >
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div v-else class="py-8 text-center">
                    <svg
                        class="mx-auto mb-3 h-12 w-12 text-gray-300"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <p class="text-gray-500">No recent activity</p>
                </div>
            </Card>
        </div>

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
                class="flex h-14 w-14 transform items-center justify-center rounded-full bg-red-500 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-red-600 hover:shadow-xl"
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

            <Link
                :href="route('inventory.add')"
                class="flex h-14 w-14 transform items-center justify-center rounded-full bg-purple-600 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-purple-700 hover:shadow-xl"
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
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
