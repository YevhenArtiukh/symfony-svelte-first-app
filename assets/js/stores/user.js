import {writable} from "svelte/store";
import globalStore from '../globalStore';

const userStore = writable(getStorageUser());

export function getStorageUser() {
    return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {jwt: null, refresh_token: null};
}

export function getToken() {
    return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).jwt : null;
}

export function getRefreshToken() {
    return localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).refresh_token : null;
}

export function setStorageUser(user) {
    globalStore.toggleItem('auth', true);
    localStorage.setItem('user', JSON.stringify(user))
}

export function setUser(user) {
    globalStore.toggleItem('auth', true);
    userStore.set(user);
}

export function logoutUser() {
    localStorage.clear();
    userStore.set({jwt: null, refresh_token: null})
    globalStore.toggleItem('auth', false);
}

export default userStore;