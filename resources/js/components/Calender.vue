<template>
    <div class="mt-2">
        <Calendar :attributes="attributes" />
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
