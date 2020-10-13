import axios from "axios";
import url from './URL';
import { getToken } from "../stores/user";
import globalStore from '../globalStore';

async function request(method, path, data = {}) {
    switch (method) {
        case 'get':
            return await axios.get(`${url}api/${path}`, {
                headers: { Authorization: `Bearer ${getToken()}` }
            })
                .then(response => JSON.parse(response.data))
                .catch(error => {
                    globalStore.flashOn('error', 'API error!!!');
                });
            break;
        case 'post':
            return await axios.post(`${url}api/${path}`, data, {
                headers: { Authorization: `Bearer ${getToken()}` }
            });
            break;
        case 'delete':
            return await axios.delete(`${url}api/${path}`, {
                headers: { Authorization: `Bearer ${getToken()}` }
            });
            break;
    }
}

export default {request};