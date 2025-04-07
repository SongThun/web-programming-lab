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
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    });

    const res = await response.json();

    if (res["status"] === "success") {
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
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    });

    const res = await response.json();

    if (res["status"] === "success") {
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
      method: "DELETE",
    });
    const res = await response.json();
    return res;
  } catch (err) {
    console.error("Delete failed:", err);
    return { status: "fail", msg: err.message };
  }
}

function handle_image() {
  const imageUpload = document.querySelector(".image-upload");
  const imagePreview = document.querySelector(".image-preview");
  const imageInput = document.querySelector(".image-upload input");

  imageInput.addEventListener("change", () => {
    file = imageInput.files[0];
    if (validFile(file)) {
      if (imagePreview === undefined) {
        imagePreview = document.createElement("div");
        imagePreview.classList.add("image-preview");
        imageUpload.appendChild(imagePreview);
      }
      imagePreview.innerHTML = "";
      const image = document.createElement("img");
      image.src = URL.createObjectURL(file);
      image.alt = file.name;
      imagePreview.appendChild(image);

      const filesize = getFileSizeDisplay(file.size);
      const desc = document.createElement("span");
      desc.innerText = `File name: ${file.name}. File size: ${filesize}`;
      imagePreview.appendChild(desc);
    } else {
      imagePreview.innerText =
        "Not valid file type. Accepted: .png, .jpg, .jpeg";
    }
  });
}

function validFile(file) {
  const fileTypes = [
    "image/apng",
    "image/bmp",
    "image/gif",
    "image/jpeg",
    "image/pjpeg",
    "image/png",
    "image/svg+xml",
    "image/tiff",
    "image/webp",
    "image/x-icon",
  ];
  return fileTypes.includes(file.type);
}

function getFileSizeDisplay(number) {
  if (number < 1e3) {
    return `${number} bytes`;
  } else if (number >= 1e3 && number < 1e6) {
    return `${(number / 1e3).toFixed(1)} KB`;
  } else {
    return `${(number / 1e6).toFixed(1)} MB`;
  }
}
