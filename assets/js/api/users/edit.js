import axios from "axios";
import url from '../URL';

async function createUser(id, {name, surname, email}) {
    return await axios.post(`${url}api/user/${id}/edit`, {
        name,
        surname,
        email
    }).catch(error => console.log(error));
}

export default createUser;