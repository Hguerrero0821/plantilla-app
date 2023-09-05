import './bootstrap';
import 'admin-lte';
import { createApp  } from 'vue/dist/vue.esm-bundler';
import submenuComponent from "@/component/menus/SubmenusComponent.vue";
import corregimientosComponent from "@/component/ubicaciones/corregimientosComponent.vue";
const app = createApp({
    components: {
        submenuComponent,
        corregimientosComponent,
    },
});
app.mount("#app");
