<div>
    <div>
        <span><a href="admin.php?page=product">back</a></span>
        <h2 class="title">Add product</h2>
    </div>
    <form id="product-form-add" action="#">
        Product name: <input name="title" type="text" placeholder="Enter a pretty name" required>
        Category: <select name="catID" id="product_cat" required>
            <?php foreach ($categories as $cat): ?>
                <option value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></option>
            <?php endforeach; ?>
        </select>
        Price: <input name="price" type="number" min="0" value="0" required>
        In stock: <input name="inStock" type="number" min="0" value="0" required>
        Discount: <input name="discount" type="number" value="0">
        Description: <textarea name="productDesc" rows="4" cols="50" placeholder="Describe your pretty product"></textarea>
        Image: <input name="imageLink" type="file" required>
        <button class="submit-btn" type="submit" value="add">Submit</button>
        <button class="edit-btn" type="none" style="display: none;">Edit</button>
    </form>
</div>

<script src="public/js/crud.js"></script>
<script>
    const form = document.querySelector("#product-form-add");
    const submitbtn = form.querySelector('.submit-btn');
    const editbtn = form.querySelector('.edit-btn');
    const title = document.querySelector('.title');
    let id = "";
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const body = await form2json(document.querySelector("#product-form-add"));
        // console.log(body);
        if (submitbtn.value == 'add') {
            new_record = await add_record('product', body);
            console.log(new_record)
            id = new_record['id'];
        }
        else {
            new_record = await edit_record('product', id, body);
        }

        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
            input.disabled = true;
        });

        submitbtn.style.display = 'none';
        editbtn.style.display = 'block';
        title.innerText = 'View Product';
    })
    document.querySelector(".edit-btn").addEventListener("click", (e) => {
        e.preventDefault();
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.disabled = false;
        });

        submitbtn.style.display = 'block';
        submitbtn.value = 'edit';
        editbtn.style.display = 'none';
        title.innerText = 'Edit Product';
    })
</script>