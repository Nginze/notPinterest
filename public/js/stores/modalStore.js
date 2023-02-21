import { createStore } from "zustand/vanilla";

const modalStore = createStore(() => ({ isOpen: false }));

export { modalStore };
