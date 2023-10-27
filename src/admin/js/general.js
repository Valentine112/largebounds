new Func().intersect_show_image("data-src", "src", 0.75, ".lazy-load-image")

function login(self) {
    let data = {
        part: "user",
        action: "admin/login",
        val: {
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        }
    }

    new Func().buttonConfig(self, "before")

    new Func().request("request.php", JSON.stringify(data), 'json')
    .then(val => {
        console.log("Yello")
        console.log(val)

        new Func().buttonConfig(self, "after")
        if(val.status === 1) window.location = "admin/home"
        return
    })
    new Func().buttonConfig(self, "after")
}

function cPassword(self) {
    const oPassword = document.getElementById("oPassword")
    const nPassword = document.getElementById("nPassword");

    let data = {
        part: "user",
        action: "admin/settings",
        val: {
            oPassword: oPassword.value,
            nPassword: nPassword.value
        }
    }

    new Func().buttonConfig(self, "before")

    new Func().request("../request.php", JSON.stringify(data), 'json')
    .then(val => {
        console.log(val)
        new Func().buttonConfig(self, "after")
        if(val.status === 1){
            document.getElementById("message").innerHTML = "<div class='alert alert-success py-1'>Password Changed</div>"
        }

        if(val.status === 0){
            document.getElementById("message").innerHTML = "<div class='alert alert-danger py-1'>Old password incorrect</div>"
        }
    })
    new Func().buttonConfig(self, "after")
}

function users(self, user) {
    let data = {
        part: "user",
        action: "admin/users",
        val: {
            wallet: self.closest(".primary").querySelector("#wallet").value,
            user: user
        }
    }

    new Func().buttonConfig(self, "before")

    new Func().request("../request.php", JSON.stringify(data), 'json')
    .then(val => {
        console.log(val)
        new Func().buttonConfig(self, "after")
        if(val.status === 1){
            document.getElementById("message").innerHTML = "<div class='alert alert-success py-1'>Wallet updated</div>"
        }

        if(val.status === 0){
            document.getElementById("message").innerHTML = "<div class='alert alert-danger py-1'>Couln't update wallet</div>"
        }
    })
    new Func().buttonConfig(self, "after")
}


function selectImage(self) {
    const func = new Func()
    let data = {
        status: 0,
        type: "error",
        message: "fill",
        content: ""
    }

    const reader = new FileReader
    const files = self.files
    const fileLength = files.length

    const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png']

    // Check if image is selected
    if(fileLength < 1) {
        data.content = "Please select an image";

        func.notice_box(data)
        return
    }

    if(!validImageTypes.includes(files[0]['type'])) {
        data.content = "Image type should be only jpg, jpeg, png";

        func.notice_box(data)
        return
    }
    // If there is an error, then the code would return and wouldn't reach here
    reader.onload = function(ev) {
        document.getElementById("image").src = ev.target.result
    }
    reader.readAsDataURL(files[0])
}

function create(self) {
    const func = new Func()
    let val = {
        status: 0,
        type: "error",
        message: "fill",
        content: "Please fill all the forms"
    }
    let error = 0
    // Validate all the forms
    const file = document.getElementById("file").files
    const name = document.getElementById("name").value
    const price = document.getElementById("price").value
    const username = document.getElementById("username").value

    error = file.length < 1 ? 1 :
            name.trim().length < 1 ? 1 :
            price.trim().length < 1 ? 1 : null

    if(error === 1) return document.getElementById("message").innerHTML = res("warning", "Please fill the forms")


    let formdata = new FormData()

    formdata.append("files[]", file[0])
    formdata.append("part", "user")
    formdata.append("action", "admin/create")
    formdata.append("type", "file")
    formdata.append("name", name)
    formdata.append("price", price)
    formdata.append("username", username)
    
    func.request("../request.php", formdata, 'file')
    .then(val => {
        new Func().buttonConfig(self, "after")
        if(val.status === 1){
            document.getElementById("message").innerHTML = res("success", "Art created successfully")
        }

        if(val.status === 0){
            document.getElementById("message").innerHTML = res("danger", "Failed to create art")
        }
    })
}

function action(self, type, id) {
    let data = {
        part: "user",
        action: "admin/action",
        val: {
            type: type,
            id: id
        }
    }

    new Func().buttonConfig(self, "before")

    new Func().request("../request.php", JSON.stringify(data), 'json')
    .then(val => {
        console.log(val)
        new Func().buttonConfig(self, "after")
        if(val.status === 1){
            document.getElementById("message").innerHTML = res("success", "Wallet updated")
        }

        if(val.status === 0){
            document.getElementById("message").innerHTML = res("danger", "Couldn't update wallet")
        }
    })
    new Func().buttonConfig(self, "after")
}

function res(type, message) {
    return `<div class='alert alert-${type} py-1'>${message}</div>`
}