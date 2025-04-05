function add_record(page, body, element, html_parse) {
    const url = `api.php?page=${page}&action=add`;
    fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    })
    .then(response => response.json())
    .then(res => {
        if (res["status"] == 'success') {
            object = res["data"];
            element.innerHTML = html_parse(res["data"]) + element.innerHTML;
        }
    })
    .catch(err => {
        console.log(err);
    });
}