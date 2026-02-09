<script setup>
defineProps({
    hover: {
        type: Boolean,
        default: false,
    },
    padding: {
        type: String,
        default: 'p-6',
    },
});
</script>

<template>
    <div
        class="rounded-lg bg-white shadow-md transition-all duration-300"
        :class="[
            padding,
            hover ? 'cursor-pointer hover:-translate-y-1 hover:shadow-xl' : '',
        ]"
    >
        <slot />
    </div>
</template>
