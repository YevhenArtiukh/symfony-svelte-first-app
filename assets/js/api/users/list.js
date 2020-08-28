import axios from "axios";
import url from '../URL';
import {getStorageUser} from "../../stores/user";

async function getUsers() {
    try {
        const response = await axios.get(`${url}api/users/list`,{
            headers: { Authorization: `Bearer ${getStorageUser().jwt}` }
        });
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }

}

export default getUsers;