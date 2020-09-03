import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function createUser({name, surname, email, password}) {
    return await axios.post(`${url}api/user/add`, {
        name,
        surname,
        email,
        password
    }, {
        headers: {Authorization: `Bearer ${getToken()}`}
    }).catch(error => console.log(error));
}

export default createUser;