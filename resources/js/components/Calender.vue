<template>
    <div class="mt-2">
        <Calendar :attributes="attributes" v-model="date" />
        <!-- <DatePicker v-model="date" /> -->
    </div>
</template>

<script>
import { Calendar, DatePicker } from "v-calendar";
import "v-calendar/dist/style.css";
export default {
    components: {
        Calendar,
        DatePicker,
    },
    props: ["appointments"],
    data() {
        return {
            date: new Date(),
        };
    },
    computed: {
        attributes() {
            return [
                // Attributes for appointments
                ...this.appointments.map((item) => ({
                    dates: item.due,
                    highlight: true,
                    popover: {
                        label: "Appointment with " + item.consultant,
                    },
                })),
            ];
        },
    },
};
</script>

<style></style>
