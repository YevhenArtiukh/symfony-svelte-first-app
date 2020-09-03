import axios from 'axios';
import url from '../URL';
import {getToken} from "../../stores/user";

async function createAuthor({name, surname, dateOfBirth}) {
    return await axios.post(`${url}api/author/add`, {
        name,
        surname,
        dateOfBirth
    }, {
        headers: {Authorization: `Bearer ${getToken()}`}
    }).catch(error => console.log(error));
}

export default createAuthor;