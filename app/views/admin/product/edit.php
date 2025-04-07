<div class="container-inset">
    <a class="flex" href="admin.php?page=product"><i class='bx bx-arrow-back me-2'></i>back</a>
    <div class="container">
        <h1 class="title mb-2">View product</h1>
        <fieldset class="form-fieldset" disabled>
            <form class="container" id="product-form-edit" action="#">
                <div class="input-row flex">
                    <div class="input-field">
                        <label>Product name:</label>
                        <input id="product-name" name="title" type="text" placeholder="Enter a pretty name" value=<?= $prod["title"] ?> required>
                    </div>
                    <div class="input-field">
                        <label>Category:</label>
                        <select name="catID" id="product_cat" value=<?= $prod["catName"] ?> required>
                            <?php foreach ($categories as $cat): ?>
                                <option value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="input-row flex">
                    <div class="input-field">
                        <label>Price:</label>
                        <div class="input-wrap">
                            <span class="ms-1">$</span>
                            <input class="input-hidden" name="price" type="number" min="0" step="0.01" value=<?= $prod["price"] ?> required>
                        </div>
                    </div>
                    <div class="input-field">
                        <label>Discount:</label>
                        <div class="input-wrap">
                            <span class="ms-1">%</span>
                            <input class="input-hidden" name="discount" type="number" step="0.01" value=<?= $prod["discount"] * 100?>>
                        </div>
                    </div>
                    <div class="input-field">
                        <label>In stock:</label>
                        <input name="inStock" type="number" min="0" step="1" value=<?= $prod["inStock"] ?> required>
                    </div>
                </div>

                <div class="text-field">
                    <label>Description:</label>
                    <textarea name="productDesc" rows="6" cols="80" placeholder="Describe your pretty product">
                        <?= $prod["productDesc"] ?>
                    </textarea>
                </div>
                <div class="image-upload">
                    <label for="">Image:</label>
                    <label class="image-upload-input" for="imageLink">Choose file</label>
                    <input id="imageLink" name="imageLink" type="file" accept=".png,.jpg,.jpeg">
                    <div class="image-preview">
                        <img id="image_preview" src=<?= "public/images/" . $prod["imageLink"] ?> alt=<?= $prod['title'] ?>>
                    </div>
                </div>
                <button style="display: none" class="submit-btn" type="submit" value=<?= $prod["id"] ?>>Submit</button>
            </form>
        </fieldset>
        <div class="flex center">
            <button class="edit-btn me-2" type="none">Edit</button>
            <button class="delete-btn" type="none">Delete</button>
        </div>
    </div>
    
</div>

<script src="public/js/crud.js"></script>
<script>
    handle_image();

    const form = document.querySelector("#product-form-edit");
    const submitbtn = form.querySelector('.submit-btn');
    const editbtn = document.querySelector('.edit-btn');
    const deletebtn = document.querySelector('.delete-btn');
    const title = document.querySelector('.title');
    const fieldset = document.querySelector('.form-fieldset');

    const id = submitbtn.value;
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const body = await form2json(form);
        // console.log(body);
        new_record = await edit_record('product', id, body);

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