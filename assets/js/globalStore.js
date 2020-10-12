import {writable} from "svelte/store";

const globalStore = writable({
    sidebar: false,
    cart: false,
    alert: false,
    alertText: 'default alert',
    alertDanger: true,
    auth: !!localStorage.getItem('user'),

    users: [],
    authors: [],
    books: [],

    flash: false,
    flashType: 'success',
    flashMessage: '',

    pageTitle: '',
    preload: true
});

const store = {
    subscribe: globalStore.subscribe,
    flashOn: (type, message) => {
        globalStore.update(storeValues => {
            return ({...storeValues, flash: true, flashType: type, flashMessage: message});
        })
    },
    flashOff: () => {
        globalStore.update( storeValues => {
            return ({...storeValues, flash: false});
        })
    },
    pageTitle: (title) => {
        globalStore.update(storeValues => {
            return ({...storeValues, pageTitle: title});
        })
    },
    toggleItem: (item, value, alertText="default", alertDanger = false) => {
        if(item === 'alert') {
            globalStore.update(storeValues => {
                return {...storeValues, [item]: value, alertText, alertDanger}
            });
        } else {
            globalStore.update(storeValues => {
                return {...storeValues, [item]: value}
            });
        }
    }
};

export default store;