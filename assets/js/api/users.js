import {request} from './_api';

export async function getUsers() {
    return await request('get', `users/list`);
}

export async function getUser(id) {
    return await request('get', `user/${id}`);
}

export async function addUser(data) {
    return await request('post', `user/add`, data);
}

export async function editUser(id, data) {
    return await request('put', `user/${id}/edit`, data)
}

export async function deleteUser(id) {
    return await request('delete', `user/${id}/delete`)
}