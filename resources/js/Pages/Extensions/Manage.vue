<template>
    <AppLayout title="Manage">
        <Container>
            <Panel :header="`Manage ${extension.title}`">
                <Message v-if="!extension.published" severity="warn">
                    This extension is currently not published, please review
                    your choices and publish below.
                </Message>
            </Panel>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Message, Panel } from 'primevue';

defineProps({
    extension: {
        type: Object,
        required: true,
    },
});
</script>
