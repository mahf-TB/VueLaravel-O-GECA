import axios from "axios";

const Axios = axios.create({
    baseURL: "http://localhost:8888/gestion-caisse-smt/src/php/"
})
export default Axios
// http://172.20.10.4:8888/