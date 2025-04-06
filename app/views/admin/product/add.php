<div>
    <div>
        <span><a href="admin.php?page=product">back</a></span>
        <h2 class="title">Add product</h2>
    </div>
    <fieldset class="form-fieldset">
        <form id="product-form-add" action="#">
            Product name: <input name="title" type="text" placeholder="Enter a pretty name" required>
            Category: <select name="catID" id="product_cat" required>
                <?php foreach ($categories as $cat): ?>
                    <option value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></option>
                <?php endforeach; ?>
            </select>
            Price: <input name="price" type="number" min="0" step="0.01" required>
            In stock: <input name="inStock" type="number" min="0" value="0" required>
            Discount: <input name="discount" type="number" value="0" step="0.01">
            Description: <textarea name="productDesc" rows="4" cols="50" placeholder="Describe your pretty product"></textarea>
            Image:
            <img id="image_preview" src="" alt=""> 
            <input id="image_upload" name="imageLink" type="file" required>
            <button class="submit-btn" type="submit" value="add">Submit</button>
        </form>
    </fieldset>
    <button class="edit-btn" type="none" style="display: none;">Edit</button>
    <button class="delete-btn" type="none" style="display: none;">Delete</button>
</div>

<script src="public/js/crud.js"></script>
<script>
    handle_image();

    const form = document.querySelector("#product-form-add");
    const submitbtn = form.querySelector('.submit-btn');
    const editbtn = document.querySelector('.edit-btn');
    const deletebtn = document.querySelector('.delete-btn');
    const title = document.querySelector('.title');
    const fieldset = document.querySelector('.form-fieldset');

    let id = "";
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const body = await form2json(form);
        // console.log(body);
        if (submitbtn.value == 'add') {
            new_record = await add_record('product', body);
            console.log(new_record)
            id = new_record['id'];
        }
        else {
            new_record = await edit_record('product', id, body);
        }
        fieldset.disabled = true;
        submitbtn.style.display = 'none';
        editbtn.style.display = 'block';
        deletebtn.style.display = 'block';
        title.innerText = 'View Product';
    })
    editbtn.addEventListener("click", (e) => {
        e.preventDefault();
        fieldset.disabled = false;
        submitbtn.style.display = 'block';
        submitbtn.value = 'edit';
        editbtn.style.display = 'none';
        deletebtn.style.display = 'none';
        title.innerText = 'Edit Product';
    })
    deletebtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const name = form.querySelector("#product-name").value;
        if (confirm(`Are you sure you want to delete ${name}?`)) {
            const result = await delete_record('product', id);
            if (result.status === 'success') {
                window.location.href = "admin.php?page=product";
            } else {
                alert("Fail to delete: " + result.msg);
            }
        }
    })
</script>