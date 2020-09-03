import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function deleteUser(id) {
    return await axios.delete(`${url}api/user/${id}/delete`, {
        headers: {Authorization: `Bearer ${getToken()}`}
    }).catch(error => console.log(error));
}

export default deleteUser;