<template>
    <AppLayout
        title="Manage"
        header="Manage extension"
        :breadcrumbs="breadcrumbs"
    >
        <Container>
            <div class="space-y-6">
                <Panel header="Actions">
                    <div class="mt-4 flex gap-4">
                        <Button
                            v-if="extension.published"
                            label="Unpublish"
                            icon="pi pi-stop"
                            severity="danger"
                            @click="submitPublishForm(false)"
                        />
                        <Button
                            v-else
                            label="Publish"
                            icon="pi pi-play"
                            severity="success"
                            @click="submitPublishForm(true)"
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
                        @submit="submitForm"
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
import { useForm } from '@inertiajs/vue3';
import { Button, Panel } from 'primevue';

const props = defineProps({
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

const breadcrumbs = [
    { label: 'Profile', url: route('profile.show') },
    { label: 'Manage extension', current: true },
];

const publishForm = useForm({
    published: !props.extension.published,
});

const submitPublishForm = (published) => {
    publishForm.published = published;
    submitForm(publishForm);
};

// Submit the form.
const submitForm = (form) => {
    form.patch(route('extensions.update', props.extension.slug));
};
</script>
