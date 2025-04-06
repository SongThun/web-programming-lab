function form2json(element) {
    const formData = new FormData(element);
    const obj = {};
    const promises = [];

    formData.forEach((value, key) => {
        if (value instanceof File) {
            const promise = new Promise((resolve) => {
                const reader = new FileReader();
                reader.onloadend = function () {
                    obj[key] = reader.result;
                    resolve();
                };
                reader.readAsDataURL(value);
            });
            promises.push(promise);
        } else {
            obj[key] = value;
        }
    });

    return Promise.all(promises).then(() => obj);
}

async function add_record(page, body) {
    const url = `api.php?page=${page}&action=add`;
    let result = {};

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(body)
        });

        const res = await response.json();

        if (res["status"] === 'success') {
            result = res["data"];
        }
    } catch (err) {
        console.log(err);
    }

    return result;
}

async function edit_record(page, id, body) {
    const url = `api.php?page=${page}&action=edit&item=${id}`;
    let result = {};

    try {
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(body)
        });

        const res = await response.json();

        if (res["status"] === 'success') {
            return res["data"];
        }
    } catch (err) {
        console.log(err);
    }

    return result;
}

async function delete_record(page, id) {
    const url = `api.php?page=${page}&action=delete&item=${id}`;
    try {
        const response = await fetch(url, {
            method: 'DELETE',
        });
        const res = await response.json();
        return res;
    } catch (err) {
        console.error('Delete failed:', err);
        return { status: 'fail', msg: err.message };
    }
}

function handle_image() {
    const file_input = document.getElementById('image_upload');
    const image_preview = document.getElementById('image_preview');

    file_input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            image_preview.src = URL.createObjectURL(file);
        }
    });
}