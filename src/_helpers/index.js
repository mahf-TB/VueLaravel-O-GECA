import router from "@/router/index";
import { jwtDecode } from 'jwt-decode';

let Connect = (to) => {
    let token = localStorage.getItem('token')

    if (token) {
        return true
    }
    router.push('/login')
}
let Deconnect = (to) => {
    let token = localStorage.getItem('token')

    if (!token) {
        return true
    }
    router.push('/')
}
let User = (to) => {
    const token = JSON.parse(localStorage.getItem("token"));
    if (token) {
        const decodedToken = jwtDecode(token)
        if (decodedToken.role == 'ADMIN') {
            return true
        }

        router.push('/')
    }
}
export const authGuard = {
    Deconnect, Connect, User
}