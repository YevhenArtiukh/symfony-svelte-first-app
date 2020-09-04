import axios from "axios";
import url from "../URL";
import {getToken} from "../../stores/user";

async function addBook({name, count, authors}) {
    return await axios.post(`${url}api/book/add`, {
        name,
        count,
        authors
    }, {
        headers: {Authorization: `Bearer ${getToken()}`}
    }).catch(error => console.log(error));
}

export default addBook;