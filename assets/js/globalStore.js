import {writable} from "svelte/store";

const globalStore = writable({
    sidebar: false,
    cart: false,
    alert: false,
    alertText: 'default alert',
    alertDanger: true,
    auth: !!localStorage.getItem('user'),

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
        });
    },
    flashOff: () => {
        globalStore.update( storeValues => {
            return ({...storeValues, flash: false});
        });
    },
    pageTitle: (title) => {
        globalStore.update(storeValues => {
            return ({...storeValues, pageTitle: title});
        });
    },
    setUser: (user) => {
        localStorage.setItem('user', JSON.stringify(user));
        globalStore.update(storeValues => {
            return ({...storeValues, auth: true})
        });
    },
    getToken: () => {
        return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).jwt : null;
    },
    getRefreshToken: () => {
        return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).refresh_token : null;
    },
    logout: () => {
        localStorage.removeItem('user');
        globalStore.update(storeValues => {
            return ({...storeValues, auth: false});
        });
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