<script setup>
import Button from '@/components/Button.vue';
import Card from '@/components/Card.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    inventoryItems: Array,
});

const form = useForm({
    items: [
        {
            item_id: '',
            quantity: '',
            note: '',
        },
    ],
});

const addItem = () => {
    form.items.push({
        item_id: '',
        quantity: '',
        note: '',
    });
};

const removeItem = (index) => {
    if (form.items.length > 1) {
        form.items.splice(index, 1);
    }
};

const getSelectedItem = (itemId) => {
    return props.inventoryItems.find((item) => item.id === parseInt(itemId));
};

const getAvailableItems = (currentIndex) => {
    const selectedIds = form.items
        .filter((_, index) => index !== currentIndex)
        .map((item) => parseInt(item.item_id))
        .filter((id) => !isNaN(id));

    return props.inventoryItems.filter(
        (item) => !selectedIds.includes(item.id),
    );
};

// const getAvailableItems = (currentIndex) => {
//     const selectedIds = form.items
//         .map((item, index) =>
//             index !== currentIndex ? Number(item.item_id) : null,
//         )
//         .filter(Boolean);

//     return props.inventoryItems.filter(
//         (item) => !selectedIds.includes(item.id),
//     );
// };

const formatQuantity = (quantity) => {
    const num = parseFloat(quantity);
    return num % 1 === 0 ? num.toFixed(0) : num.toFixed(2);
};

const getMaxQuantity = (itemId) => {
    const item = getSelectedItem(itemId);
    return item ? parseFloat(item.quantity) : 0;
};

const submit = () => {
    form.post(route('inventory.deduct.stock'));
};
</script>

<template>
    <Head title="Deduct Stock" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('dashboard')"
                    class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600"
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </Link>
                <h1 class="text-2xl font-bold text-gray-900">Deduct Stock</h1>
            </div>
        </template>

        <div class="mx-auto max-w-4xl">
            <!-- Empty State -->
            <div v-if="inventoryItems.length === 0">
                <Card>
                    <div class="py-12 text-center">
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
                        <p class="mb-4 text-gray-500">
                            No inventory items available to deduct stock from.
                        </p>
                        <Link :href="route('inventory.add')">
                            <Button variant="success">Add Stock First</Button>
                        </Link>
                    </div>
                </Card>
            </div>

            <template v-else>
                <!-- Info Banner -->
                <div
                    class="mb-6 flex items-start gap-4 rounded-xl border border-orange-100 bg-orange-50 p-4"
                >
                    <div class="rounded-lg bg-orange-100 p-2">
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
                                d="M17 13l-5 5m0 0l-5-5m5 5V6"
                            />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-orange-900">
                            Deduct Stock from Inventory
                        </p>
                        <p class="text-sm text-orange-700">
                            Select items and enter the quantity to deduct. Only
                            items with available stock are shown.
                        </p>
                    </div>
                </div>

                <Card>
                    <form @submit.prevent="submit">
                        <!-- Items List -->
                        <div class="space-y-6">
                            <TransitionGroup
                                enter-active-class="transition ease-out duration-300"
                                enter-from-class="opacity-0 -translate-y-4"
                                enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition ease-in duration-200"
                                leave-from-class="opacity-100 translate-y-0"
                                leave-to-class="opacity-0 -translate-y-4"
                            >
                                <div
                                    v-for="(item, index) in form.items"
                                    :key="index"
                                    class="relative rounded-xl border-2 border-gray-100 bg-gray-50 p-6"
                                >
                                    <!-- Item Header -->
                                    <div
                                        class="mb-6 flex items-center justify-between"
                                    >
                                        <div class="flex items-center gap-3">
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
                                                        d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                                    />
                                                </svg>
                                            </div>
                                            <h3
                                                class="font-semibold text-gray-900"
                                            >
                                                Stock Deduction {{ index + 1 }}
                                            </h3>
                                        </div>
                                        <button
                                            v-if="form.items.length > 0"
                                            type="button"
                                            @click="removeItem(index)"
                                            class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600"
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
                                                    d="M6 18L18 6M6 6l12 12"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="grid gap-6 md:grid-cols-3">
                                        <div>
                                            <label
                                                class="mb-2 block text-sm font-medium text-gray-700"
                                            >
                                                Select Item
                                                <span class="text-red-500"
                                                    >*</span
                                                >
                                            </label>
                                            <select
                                                v-model="item.item_id"
                                                class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-all duration-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500"
                                            >
                                                <option value="">
                                                    Choose an item
                                                </option>
                                                <option
                                                    v-for="invItem in getAvailableItems(
                                                        index,
                                                    )"
                                                    :key="invItem.id"
                                                    :value="invItem.id"
                                                >
                                                    {{ invItem.name }} ({{
                                                        formatQuantity(
                                                            invItem.quantity,
                                                        )
                                                    }}
                                                    {{ invItem.unit }})
                                                </option>
                                            </select>

                                            <p
                                                v-if="
                                                    form.errors[
                                                        `items.${index}.inventory_item_id`
                                                    ]
                                                "
                                                class="mt-1 text-sm text-red-500"
                                            >
                                                {{
                                                    form.errors[
                                                        `items.${index}.inventory_item_id`
                                                    ]
                                                }}
                                            </p>
                                        </div>
                                        <div>
                                            <label
                                                class="mb-2 block text-sm font-medium text-gray-700"
                                            >
                                                Quantity to Deduct
                                                <span class="text-red-500"
                                                    >*</span
                                                >
                                            </label>
                                            <div class="relative">
                                                <input
                                                    v-model="item.quantity"
                                                    type="number"
                                                    step="0.0001"
                                                    min="0.0001"
                                                    :max="
                                                        getMaxQuantity(
                                                            item.item_id,
                                                        )
                                                    "
                                                    placeholder="0"
                                                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 pr-16 transition-all duration-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500"
                                                />
                                                <span
                                                    v-if="
                                                        getSelectedItem(
                                                            item.item_id,
                                                        )
                                                    "
                                                    class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-500"
                                                >
                                                    {{
                                                        getSelectedItem(
                                                            item.inventory_item_id,
                                                        )?.unit
                                                    }}
                                                </span>
                                            </div>
                                            <p
                                                v-if="
                                                    getSelectedItem(
                                                        item.item_id,
                                                    )
                                                "
                                                class="mt-1 text-xs text-gray-500"
                                            >
                                                Available:
                                                {{
                                                    formatQuantity(
                                                        getSelectedItem(
                                                            item.item_id,
                                                        )?.quantity,
                                                    )
                                                }}
                                                {{
                                                    getSelectedItem(
                                                        item.item_id,
                                                    )?.unit
                                                }}
                                            </p>
                                        </div>

                                        <div>
                                            <label
                                                class="mb-2 block text-sm font-medium text-gray-700"
                                            >
                                                Notes (Optional)
                                            </label>
                                            <input
                                                v-model="item.note"
                                                type="text"
                                                placeholder="e.g. Sold to Customer"
                                                class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-all duration-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500"
                                            />
                                            <p
                                                v-if="
                                                    form.errors[
                                                        `items.${index}.note`
                                                    ]
                                                "
                                                class="mt-1 text-sm text-red-500"
                                            >
                                                {{
                                                    form.errors[
                                                        `items.${index}.note`
                                                    ]
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </TransitionGroup>
                        </div>
                        <!-- Add More Button -->
                        <div class="mt-6">
                            <button
                                type="button"
                                @click="addItem"
                                :disabled="
                                    form.items.length >= inventoryItems.length
                                "
                                class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 p-4 text-gray-500 transition-all duration-200 hover:border-orange-500 hover:bg-orange-50 hover:text-orange-600 disabled:cursor-not-allowed disabled:opacity-50"
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
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                                Add Another Item
                            </button>
                        </div>

                        <!-- Actions -->
                        <div
                            class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6"
                        >
                            <Link :href="route('dashboard')">
                                <Button variant="ghost">Cancel</Button>
                            </Link>
                            <Button
                                type="submit"
                                variant="warning"
                                :loading="form.processing"
                                :disabled="form.processing"
                            >
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
                                        d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                    />
                                </svg>
                                Deduct Stock
                            </Button>
                        </div>
                    </form>
                </Card>
            </template>
        </div>
    </AuthenticatedLayout>
</template>
