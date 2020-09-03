import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function editUser(id, {name, surname, email}) {
    return await axios.post(`${url}api/user/${id}/edit`, {
        name,
        surname,
        email,
        password: ''
    }, {
        headers: { Authorization: `Bearer ${getToken()}` }
    }).catch(error => console.log(error));
}

export default editUser;