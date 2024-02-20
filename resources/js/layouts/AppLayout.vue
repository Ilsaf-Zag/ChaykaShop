<script setup lang="ts">
import HeaderUser from '@components/Header/HeaderUser.vue'
import ChatDefault from "@components/Chat/ChatDefault.vue";
import ChatToggle from "@components/Chat/ChatToggle.vue";
import {router} from "@inertiajs/vue3";
import axios from "axios";
import {ref} from "vue";

</script>

<template>
    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            <HeaderUser/>
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <slot></slot>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->

            <ChatToggle>
                <ChatDefault

                />
            </ChatToggle>

        </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->
</template>
