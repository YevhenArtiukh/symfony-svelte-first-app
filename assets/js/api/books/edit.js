import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function editBook(id, {name, count, authors}) {
    return await axios.post(`${url}api/book/${id}/edit`, {
        name,
        count,
        authors
    }, {
        headers: { Authorization: `Bearer ${getToken()}` }
    }).catch(error => console.log(error));
}

export default editBook;