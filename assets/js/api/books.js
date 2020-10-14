import {request} from "./_api";

export async function getBooks() {
    return await request('get', `books/list`);
}

export async function getBook(id) {
    return await request('get', `book/${id}`);
}

export async function addBook(data) {
    return await request('post', `book/add`, data);
}

export async function editBook(id, data) {
    return await request('put', `book/${id}/edit`, data);
}

export async function deleteBook(id) {
    return await request('delete', `book/${id}/delete`);
}