import {auth} from './_api';

export async function loginUser({email, password}) {
    return await auth(`login_check`, {username: email, password});
}

export async function refreshToken(refresh_token) {
    return await auth(`token/refresh`, {refresh_token});
}