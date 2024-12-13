<template>
    <AppLayout title="Manage">
        <Container>
            <div class="space-y-6">
                <Message
                    v-if="!extension.published"
                    icon="pi pi-exclamation-triangle"
                    severity="error"
                >
                    This extension is currently not published, please review
                    your choices and publish below.
                </Message>
                <Panel header="Manage extension">
                    <div class="flex gap-4">
                        <Button
                            v-if="extension.published"
                            label="Unpublish"
                            icon="pi pi-stop"
                            severity="danger"
                        />
                        <Button
                            v-else
                            label="Publish"
                            icon="pi pi-play"
                            severity="success"
                        />
                        <Button
                            label="Delete"
                            icon="pi pi-trash"
                            severity="danger"
                            outlined
                        />
                    </div>
                </Panel>
                <Panel header="Update details">
                    <ExtensionForm
                        class="mt-6"
                        :tags="tags"
                        button-label="Update"
                        :repositories="repositories"
                        :extension="extension"
                    />
                </Panel>
            </div>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ExtensionForm from '@/Pages/Extensions/Partials/ExtensionForm.vue';
import { Button, Message, Panel } from 'primevue';

defineProps({
    extension: {
        type: Object,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
    repositories: {
        type: Array,
        required: true,
    },
});
</script>
