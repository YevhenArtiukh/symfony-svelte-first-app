import axios from "axios";
import url from '../URL';

async function deleteUser(id) {
    return await axios.delete(`${url}api/user/${id}/delete`).catch(error => console.log(error));
}

export default deleteUser;