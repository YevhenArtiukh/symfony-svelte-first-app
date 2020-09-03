import axios from 'axios';
import url from './URL';
import {setStorageUser, setUser} from "../stores/user";

export async function loginUser({email, password}) {
    const response = await axios.post(`${url}api/login_check`, {
        username: email,
        password
    }).catch(error => console.log(error));

    if(response) {
        const jwt = response.data.token;
        const refresh_token = response.data.refresh_token;
        const user = {jwt, refresh_token};
        setStorageUser(user);
        setUser(user);
    }

    return response;
}

export async function refreshToken(refresh_token) {
    const response = await axios.post(`${url}api/token/refresh`, {
        refresh_token
    }).catch(error => console.log(error));

    if (response) {
        const jwt = response.data.token;
        const refresh_token = response.data.refresh_token;
        const user = {jwt, refresh_token};
        setStorageUser(user);
        setUser(user);
    }

    return response;
}

export default {loginUser, refreshToken};