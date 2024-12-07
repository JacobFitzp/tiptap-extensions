<template>
    <Head>
        <title>{{ title }}</title>
        <slot name="head" />
    </Head>
    <div class="sticky top-6 mx-auto my-6 max-w-5xl">
        <Menubar :model="items">
            <template #start>
                <img alt="" width="35" height="35" src="/assets/logo.svg" />
            </template>
            <template #end>
                <div class="flex items-center gap-2">
                    <InputText
                        placeholder="Search"
                        type="text"
                        class="w-32 sm:w-auto"
                    />

                    <template v-if="$page.props.auth.user">
                        <Avatar
                            :image="$page.props.auth.user.avatar"
                            shape="circle"
                            @click="toggleProfileMenu"
                            class="cursor-pointer"
                            aria-haspopup="true"
                            aria-controls="overlay_menu"
                        />
                        <Menu
                            ref="profileMenu"
                            :model="profileItems"
                            :popup="true"
                        />
                    </template>

                    <Button
                        v-else
                        as="a"
                        :href="route('auth.redirect')"
                        icon="pi pi-github"
                        label="Sign-in"
                    ></Button>
                </div>
            </template>
        </Menubar>
    </div>

    <slot />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Avatar, Button, InputText, Menu, Menubar } from 'primevue';
import { ref } from 'vue';

defineProps({
    title: {
        type: String,
        required: true,
    },
});

const items = ref([
    {
        label: 'Home',
        icon: 'pi pi-home',
    },
    {
        label: 'Trending',
        icon: 'pi pi-chart-line',
    },
]);

const profileMenu = ref();
const profileItems = ref([
    {
        label: 'Profile',
    },
    {
        label: 'Submit',
    },
    {
        label: 'Logout',
        as: Link,
        url: route('auth.logout'),
    },
]);

const toggleProfileMenu = (event) => {
    profileMenu.value.toggle(event);
};
</script>
