<script setup>
import Button from '@/components/Button.vue';
import Card from '@/components/Card.vue';
import Modal from '@/components/Modal.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    items: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const showDeleteModal = ref(false);
const itemToDelete = ref(null);

let searchTimeout = null;
const searchItems = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            route('inventory.index'),
            { search: search.value },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 300);
};

watch(search, searchItems);

const confirmDelete = (item) => {
    itemToDelete.value = item;
    showDeleteModal.value = true;
};

const deleteItem = () => {
    // router.delete(route('inventory.delete', itemToDelete.value.id), {
    router.delete(route('dashboard', itemToDelete.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
            itemToDelete.value = null;
        },
    });
};

const formatQuantity = (quantity) => {
    const num = parseFloat(quantity);
    return num % 1 === 0 ? num.toFixed(0) : num.toFixed(2);
};

const getStockStates = (quantity) => {
    const qty = parseFloat(quantity);
    if (qty <= 0)
        return { label: 'Out of Stock', color: 'bg-red-100 text-red-800' };
    if (qty < 10)
        return { label: 'Low Stock', class: 'bg-orange-100 text-orange-800' };
    return { label: 'In Stock', class: 'bg-green-100 text-green-800' };
};
</script>

<template>
    <Head title="Inventory Items" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-gray-900">Inventory</h1>
        </template>
        <Card>
            <!-- Header with Search and Actions -->
            <div
                class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <!-- Search -->
                <div class="relative max-w-md flex-1">
                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                    >
                        <svg
                            class="h-5 w-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </div>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search items..."
                        class="block w-full rounded-xl border-2 border-gray-200 py-3 pr-4 pl-10 transition-all duration-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                    />
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <Link :href="route('inventory.add')">
                        <Button variant="success">
                            <svg
                                class="mr-2 h-5 w-5"
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
                            Add Stock
                        </Button>
                    </Link>
                    <Link :href="route('inventory.create')">
                        <Button variant="primary">
                            <svg
                                class="mr-2 h-5 w-5"
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
                            Add Items
                        </Button>
                    </Link>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold tracking-wider text-gray-600 uppercase"
                            >
                                Item
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold tracking-wider text-gray-600 uppercase"
                            >
                                Quantity
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold tracking-wider text-gray-600 uppercase"
                            >
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold tracking-wider text-gray-600 uppercase"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <tr
                            v-for="item in items.data"
                            :key="items.id"
                            class="transition-colors hover:bg-gray-50"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <Link
                                    :href="route('inventory.show', item.id)"
                                    class="group flex items-center gap-3"
                                >
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 transition-colors group-hover:bg-indigo-200"
                                    >
                                        <svg
                                            class="h-5 w-5 text-indigo-600"
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
                                    </div>
                                    <div>
                                        <p
                                            class="font-medium text-gray-900 transition-colors group-hover:text-indigo-600"
                                        >
                                            {{ item.name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ item.unit?.name }}
                                        </p>
                                    </div>
                                </Link>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <span
                                    class="text-lg font-semibold"
                                    :class="{
                                        'text-red-600':
                                            parseFloat(item.quantity) <= 0,
                                        'text-orange-600':
                                            parseFloat(item.quantity) > 0 &&
                                            parseFloat(item.quantity) < 10,
                                        'text-gray-900':
                                            parseFloat(item.quantity) >= 10,
                                    }"
                                >
                                    {{ formatQuantity(item.quantity) }}
                                </span>
                                <span class="ml-1 text-sm text-gray-500">{{
                                    item.unit
                                }}</span>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium"
                                    :class="getStockStates(item.quantity).class"
                                >
                                    {{ getStockStates(item.quantity).label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div
                                    class="flex items-center justify-end gap-2"
                                >
                                    <Link
                                        :href="route('inventory.show', item.id)"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-indigo-50 hover:text-indigo-600"
                                        title="View"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="route('inventory.show', item.id)"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-yellow-50 hover:text-yellow-600"
                                        title="Edit"
                                    >
                                        <!--  <Link
                                        :href="route('inventory.edit', item.id)"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-yellow-50 hover:text-yellow-600"
                                        title="Edit"
                                    > -->
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            />
                                        </svg>
                                    </Link>
                                    <button
                                        @click="confirmDelete(item)"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600"
                                        title="Delete"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="items.data.length === 0">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg
                                    class="mx-auto mb-4 h-16 w-16 text-gray-300"
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
                                <p class="mb-4 text-gray-500">No items found</p>
                                <Link :href="route('items.add')">
                                    <Button variant="primary">
                                        <svg
                                            class="mr-2 h-5 w-5"
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
                                        Add Your First Item
                                    </Button>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                v-if="items.links.length > 3"
                class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <p class="text-sm text-gray-600">
                    Showing <span class="font-medium">{{ items.from }}</span> to
                    <span class="font-medium">{{ items.to }}</span> of
                    <span class="font-medium">{{ items.total }}</span> items
                </p>
                <div class="flex gap-1">
                    <template v-for="link in items.links" :key="link.label">
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            class="rounded-lg px-4 py-2 text-sm font-medium transition-colors"
                            :class="{
                                'bg-indigo-600 text-white': link.active,
                                'text-gray-700 hover:bg-gray-100': !link.active,
                            }"
                        />
                        <span
                            v-else
                            v-html="link.label"
                            class="px-4 py-2 text-sm text-gray-400"
                        />
                    </template>
                </div>
            </div>
        </Card>

        <!-- Delete Confirmation Modal -->
        <Modal
            :show="showDeleteModal"
            @close="showDeleteModal = false"
            max-width="sm"
        >
            <div class="p-6">
                <div
                    class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100"
                >
                    <svg
                        class="h-6 w-6 text-red-600"
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
                <h3
                    class="mb-2 text-center text-lg font-semibold text-gray-900"
                >
                    Delete Item
                </h3>
                <p class="mb-6 text-center text-gray-600">
                    Are you sure you want to delete
                    <strong>{{ itemToDelete?.name }}</strong
                    >? This action cannot be undone.
                </p>
                <div class="flex gap-3">
                    <Button
                        variant="ghost"
                        class="flex-1"
                        @click="showDeleteModal = false"
                    >
                        Cancel
                    </Button>
                    <Button variant="danger" class="flex-1" @click="deleteItem">
                        Delete
                    </Button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
