import {writable} from "svelte/store";

const userStore = writable(getStorageUser());

export function getStorageUser() {
    return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {username: null, jwt: null};
}

export function setStorageUser(user) {
    localStorage.setItem('user', JSON.stringify(user))
}

export function setUser(user) {
    userStore.set(user);
}

export function logoutUser() {
    console.log('local clear');
    localStorage.clear();
    userStore.set({username:null, jwt: null})
}

export default userStore;