


export function request (url, method, data = {}) {
	return axios({
		url: '/api'+ url,
		method: method,
		data: data,
        params: method == "GET" ? data : {},
	})
}
