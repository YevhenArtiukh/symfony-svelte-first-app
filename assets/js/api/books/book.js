import axios from "axios";
import url from '../URL';
import {getToken} from "../../stores/user";

async function getBook(id) {
    try {
        const response = await axios.get(`${url}api/book/${id}`, {
            headers: {Authorization: `Bearer ${getToken()}`}
        });
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }
}

export default getBook;