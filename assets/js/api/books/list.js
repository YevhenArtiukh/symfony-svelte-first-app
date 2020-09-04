import axios from "axios";
import url from "../URL";
import {getToken} from "../../stores/user";

async function getBooks() {
    try {
        const response = await axios.get(`${url}api/books/list`,{
            headers: { Authorization: `Bearer ${getToken()}` }
        });
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }
}

export default getBooks;