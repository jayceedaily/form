import { http } from "../services/http";

const baseUrl = '/form';

export const formApi = {

    index: async (filters = {}) => {
        return await http.get(baseUrl, filters);
    },

    show: async (key) => {
        return await http.get(baseUrl + '/' + key);
    },

    update: async (key) => {
        return await http.update(baseUrl + '/' + key);
    },

    store: async(payload) => {
        return await http.post(baseUrl, payload);
    },

    delete: async (key) => {
        return await http.destroy(baseUrl + '/' + key);
    }
}
