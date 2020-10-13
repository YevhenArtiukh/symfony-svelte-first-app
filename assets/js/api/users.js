import api from './api';

export async function getUsers() {
    return await api.request('get', 'users/list');
}

export async function getUser(id) {
    return await api.request('get', 'user/'+id);
}

export async function addUser(data) {
    return await api.request('post', 'user/add', data);
}

export async function editUser(id, data) {
    return await api.request('post', 'user/'+id+'/edit', data)
}

export async function deleteUser(id) {
    return await api.request('delete', 'user/'+id+'/delete')
}