export const http = {

	get: async (url, method = 'GET') =>
	{
		return await request(url, method)
					.then(response =>
					{
						return response;
					})
					.catch(error =>
					{
						return error.response;
					})
	},

	post: async (url, data, method = 'POST') =>
	{
		return await request(url, method, data)
					.then(response =>
					{
						return response;
					})
					.catch(error =>
					{
						return error.response;
					});
	},

	index: async (url, method = 'GET') =>
	{
		return await request(url, method)
					.then(response =>
					{
						return response;
					})
					.catch(error =>
					{
						return error.response;
					})
	},

	store: async (url, data, method = 'POST') =>
	{
		return await request(url, method, data)
					.then(response =>
					{
						return response;
					})
					.catch(error =>
					{
						return error.response;
					});
	},

	update: async (url, data, method = 'PUT') =>
	{
        return await http.store(url, data, method)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	},

	show: async (url, method = 'GET') =>
	{
        return await http.index(url, method)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	},

	edit: async (url, method = 'GET') =>
	{
        return await http.index(url, method)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	},

	destroy: async (url, method = 'DELETE') =>
	{
        return await http.get(url, method)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	},

	toggle: async (url, method = 'PUT') =>
	{
        return await http.update(url, null, method)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	},

	upload: async(url, data) =>
	{
        return await http.post(url, data)
                    .then(response =>
                    {
                        return response;
                    })
                    .catch(error =>
                    {
                        return error.response;
                    });
	}
}
