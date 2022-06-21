require("./bootstrap");

import { createApp } from "vue";
import Calender from "./components/Calender";

const app = createApp({});

app.component("calender", Calender);

app.mount("#app");
