import RequestLifecycle from '../api/lifecycle';

function convert(json) {
    return '?' +
        Object.keys(json).map(function (key) {
            if (json[key] === undefined) {
                json[key] = ""
            }
                return encodeURIComponent(key) + '=' +
                    encodeURIComponent(json[key]);

        }).join('&');
}

export default function (url) {
    return {
        async get(data = "") {
            if (data) {
                data = convert(data);
            }

            return await RequestLifecycle({
                method: 'GET',
                url: `${url}${data}`,
            });
        },
        async post(data = "") {
            return await RequestLifecycle({
                method: 'POST',
                url: `${url}`,
                data,
            });
        },
        async put(data = "") {
            return await RequestLifecycle({
                method: 'PUT',
                url: `${url}`,
                data
            });
        },
        async delete(data = "") {
            if (data) {
                data = convert(data);
            }
            return await RequestLifecycle({
                method: 'DELETE',
                url: `${url}${data}`
            });
        },
        async download(data) {
            if (data) {
                data = convert(data);
            }
            return await RequestLifecycle({
                method: 'GET',
                url: `${url}${data}`,
                responseType: 'blob'
            });
        }
    };
}
