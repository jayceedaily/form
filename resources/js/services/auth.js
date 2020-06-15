import { http } from "./http";

export const authenticate = {
    ...{post:http.post, get:http.get},
	getToken: () =>
	{
		let access_token = cookies.get('pms_access_token');

		return access_token;
	},

	setToken: () =>
	{
		axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.token;
	},

	hasToken: () => {

		return localStorage.token ? true : false;

	},

	destroyToken: () =>
	{
		localStorage.removeItem('token');

		delete axios.defaults.headers.common['Authorization'];
	},

	isAuthenticated: () =>
	{
		return authenticate.getToken();
	}
}
