import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function deleteAuthor(id) {
    return await axios.delete(`${url}api/author/${id}/delete`, {
        headers: {Authorization: `Bearer ${getToken()}`}
    }).catch(error => console.log(error));
}

export default deleteAuthor;