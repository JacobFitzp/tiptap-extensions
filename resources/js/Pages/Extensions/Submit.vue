<template>
    <AppLayout title="Submit an extension">
        <Container>
            <Panel header="Submit an extension">
                <ExtensionForm
                    :tags="tags"
                    :repositories="repositories"
                    @submit="submitForm"
                />
            </Panel>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ExtensionForm from '@/Pages/Extensions/Partials/ExtensionForm.vue';
import { Panel } from 'primevue';

defineProps({
    tags: {
        type: Array,
        required: true,
    },
    repositories: {
        type: Array,
        required: true,
    },
});

// Submit the form.
const submitForm = (form) => {
    form.post(route('extensions.submit'), {
        preserveScroll: true,
    });
};
</script>
