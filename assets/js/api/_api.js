import axios from "axios";
import url from './_url';
import globalStore from '../globalStore';
import {refreshToken} from "./auth";
import {router} from "../App.svelte";

export async function request(method, path, data = {}) {
    switch (method) {
        case 'get':
            return await axios.get(`${url}api/${path}`, {
                headers: { Authorization: `Bearer ${globalStore.getToken}` }
            })
                .then(response => JSON.parse(response.data))
                .catch(error => {
                    globalStore.flashOn('error', 'API error!!!');
                });
            break;
        case 'post':
            return await axios.post(`${url}api/${path}`, data, {
                headers: { Authorization: `Bearer ${globalStore.getToken}` }
            })
                .catch(() => {
                    globalStore.flashOn('error', 'API error!!!');
                });
            break;
        case 'put':
            return await axios.put(`${url}api/${path}`, data, {
                headers: { Authorization: `Bearer ${globalStore.getToken}` }
            })
                .catch(() => {
                    globalStore.flashOn('error', 'API error!!!');
                });
            break;
        case 'delete':
            return await axios.delete(`${url}api/${path}`, {
                headers: { Authorization: `Bearer ${globalStore.getToken}` }
            })
                .catch(() => {
                    globalStore.flashOn('error', 'API error!!!');
                });
            break;
    }
}

export async function auth(path, data = {}) {
    return await axios.post(`${url}api/${path}`, data)
        .then(response => {
            const jwt = response.data.token;
            const refresh_token = response.data.refresh_token;
            globalStore.setUser({jwt, refresh_token});
        });
}