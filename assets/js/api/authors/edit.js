import axios from 'axios';
import url from '../URL';
import {getToken} from "../../stores/user";

async function editAuthor(id, {name, surname, dateOfBirth}) {
    return await axios.post(`${url}api/author/${id}/edit`, {
        name,
        surname,
        dateOfBirth
    }, {
        headers: { Authorization: `Bearer ${getToken()}` }
    }).catch(error => console.log(error));
}

export default editAuthor;