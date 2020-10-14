import {request} from './_api';

export async function getAuthors() {
    return await request('get', `authors/list`);
}

export async function getAuthor(id) {
    return await request('get', `author/${id}`);
}

export async function addAuthor(data) {
    return await request('post', `author/add`, data);
}

export async function editAuthor(id, data) {
    return await request('put', `author/${id}/edit`, data)
}

export async function deleteAuthor(id) {
    return await request('delete', `author/${id}/delete`)
}