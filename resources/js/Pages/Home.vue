<template>
    <AppLayout title="Home">
        <Container>
            <Panel header="Have something to share?">
                <p class="m-0">
                    Built something awesome? Why not share it with the
                    community!
                </p>
                <p class="mt-4">
                    You also help in other ways by contributing to this project,
                    or donating a small amount to keep things running.
                </p>
                <div class="mt-6 flex gap-4">
                    <Button :as="Link" :href="route('extensions.submit')"
                        >Submit an extension</Button
                    >
                    <Button
                        severity="secondary"
                        icon="pi pi-github"
                        label="Contribute to this project"
                    ></Button>
                    <Button
                        severity="secondary"
                        icon="pi pi-pound"
                        label="Buy me a coffee"
                    ></Button>
                </div>
            </Panel>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Button, Panel } from 'primevue';
</script>
