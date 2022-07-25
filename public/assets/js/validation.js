let sbt = document.getElementsByClassName("submit")[0];
sbt.onclick = function(e){     
    
    let form = document.forms['form_validation'];
    
    if(form["name"].value == ''){
        e.preventDefault(); 
        let name = document.getElementsByName("name")[0];
        // nextElementSibling works for getting name element's next sibling.
        name.nextElementSibling.innerText = "The name field is required.";
    }else{
        let name = document.getElementsByName("name")[0];
        name.nextElementSibling.innerText = " ";
    }
    
    // Valid email validation.
    if(/^[a-z0-9._]+@[a-z._]+$/.test(form["email"].value)){
        let email = document.getElementsByName("email")[0];
        email.nextElementSibling.innerText = " ";
    }else{
        if(form["email"].value == ''){
            e.preventDefault(); 
            let email = document.getElementsByName("email")[0];
            email.nextElementSibling.innerText = "The email field is required.";
        }else{
            e.preventDefault(); 
            console.log(form["email"].value);
            let email = document.getElementsByName("email")[0];
            email.nextElementSibling.innerText = "Sorry! email is invalid.";
        }
    }

    // if(form["password"].value == ''){
    //     e.preventDefault(); 
    //     let password = document.getElementsByName("password")[0];
    //     password.nextElementSibling.innerText = "The password field is required.";
    // }else if(form["password"].value.length < 6){
    //     // if password character length validation
    //     e.preventDefault(); 
    //     let password = document.getElementsByName("password")[0];
    //     password.nextElementSibling.innerText = "Your password should be more then 6 character.";
    // }else{
    //     let password = document.getElementsByName("password")[0];
    //     password.nextElementSibling.innerText = " ";
    // }
    
    if(form["phone"].value == ''){
        e.preventDefault(); 
        let phone = document.getElementsByName("phone")[0];
        phone.nextElementSibling.innerText = "The phone field is required.";
    }else if(form["phone"].value.length >= 11){
        // if phone character length validation
        e.preventDefault(); 
        let phone = document.getElementsByName("phone")[0];
        phone.nextElementSibling.innerText = "Your phone number should be maximum 10 digits.";
    }else{
        let phone = document.getElementsByName("phone")[0];
        phone.nextElementSibling.innerText = " ";
    }
    
    if(form["image"].value == ''){
        e.preventDefault(); 
        let image = document.getElementsByName("image")[0];
        image.nextElementSibling.innerText = "The image field is required.";
    }else{
        let image = document.getElementsByName("image")[0];
        image.nextElementSibling.innerText = " ";
    }
    
    // if(form["zip"].value == ''){
    //     e.preventDefault();
    //     let zip = document.getElementsByName("zip")[0]; 
    //     zip.nextElementSibling.innerText = "The zip field is required.";
    // }else if(form["zip"].value.length >= 6){
    //     // if zip character length validation
    //     e.preventDefault(); 
    //     let zip = document.getElementsByName("zip")[0];
    //     zip.nextElementSibling.innerText = "Your zip number should be maximum 6 digits.";
    // }else{
    //     let zip = document.getElementsByName("zip")[0]; 
    //     zip.nextElementSibling.innerText = " ";
    // }

    // if(form["post_name"].value == ''){
    //     e.preventDefault();
    //     let post_name = document.getElementsByName("post_name")[0]; 
    //     post_name.nextElementSibling.innerText = "The post_name field is required.";
    // }else{
    //     let post_name = document.getElementsByName("post_name")[0]; 
    //     post_name.nextElementSibling.innerText = " ";
    // }

    // else if(form["post_name"].value.length >= 6){
    //     // if post name character length validation
    //     e.preventDefault(); 
    //     let post_name = document.getElementsByName("post_name")[0];
    //     post_name.nextElementSibling.innerText = "Your postal name should be maximum 6 digits.";
    // }
    
    if(form["block"].value == ''){
        e.preventDefault(); 
        let block = document.getElementsByName("block")[0];
        block.nextElementSibling.innerText = "The block field is required.";
    }else{
        let block = document.getElementsByName("block")[0];
        block.nextElementSibling.innerText = " ";
    }
    
    if(form["district"].value == ''){
        e.preventDefault(); 
        let district = document.getElementsByName("district")[0];
        district.nextElementSibling.innerText = "The district field is required.";
    }else{
        let district = document.getElementsByName("district")[0];
        district.nextElementSibling.innerText = " ";
    }
    
    if(form["region"].value == ''){
        e.preventDefault(); 
        let region = document.getElementsByName("region")[0];
        region.nextElementSibling.innerText = "The region field is required.";
    }else{
        let region = document.getElementsByName("region")[0];
        region.nextElementSibling.innerText = " ";
    }
    
    if(form["state"].value == ''){
        e.preventDefault(); 
        let state = document.getElementsByName("state")[0];
        state.nextElementSibling.innerText = "The state field is required.";
    }else{
        let state = document.getElementsByName("state")[0];
        state.nextElementSibling.innerText = " ";
    }
    
    if(form["contry"].value == ''){
        e.preventDefault(); 
        let contry = document.getElementsByName("contry")[0];
        contry.nextElementSibling.innerText = "The contry field is required.";
    }else{
        let contry = document.getElementsByName("contry")[0];
        contry.nextElementSibling.innerText = " ";
    }
    
    if(form["age"].value == ''){
        e.preventDefault(); 
        let age = document.getElementsByName("age")[0];
        age.nextElementSibling.innerText = "The age field is required.";
    }else{
        let age = document.getElementsByName("age")[0];
        age.nextElementSibling.innerText = " ";
    }
}

// Number are allowed and alpha are not allowed.
let phone_validate = document.getElementsByName("phone")[0];
phone_validate.onkeydown = function (e) {
    if(/^[0-9]+$/.test(phone_validate.value)){
        phone_validate.nextElementSibling.innerText = " ";
    }else{
        phone_validate.nextElementSibling.innerText = "Only 10 numbers are allowed.";
    }
}

// Create variable.
// Number are allowed and alpha are not allowed.
let zip_validate = document.getElementsByName("zip")[0];

// String are allowed and alpha are not allowed.
let string_validate = document.getElementsByName("post_name")[0];

// zip validatin function
zip_validate.onkeydown = function (e) {
    if(/^[0-9]+$/.test(zip_validate.value)){
        zip_validate.nextElementSibling.innerText = " ";
        // if selected one so other automatically disabled.
        string_validate.disabled = "disabled";
    }else if(zip_validate.value == ""){
        // if value will be empty so text box automatically enabled.
        string_validate.disabled = "";
    }else{
        zip_validate.nextElementSibling.innerText = "Only 6 numbers are allowed.";
        // if selected one so other automatically disabled.
        string_validate.disabled = "disabled";
    }
}

// post name validation functino.
string_validate.onkeydown = function (e) {
    if(/^[a-z]+$/i.test(string_validate.value)){
        string_validate.nextElementSibling.innerText = " ";
        // if selected one so other automatically disabled.
        zip_validate.readOnly = "true";
    }else if(string_validate.value == ""){
        // if value will be empty so text box automatically enabled.
        zip_validate.readOnly = "false";
    }else{
        string_validate.nextElementSibling.innerText = "Only postal name are allowed.";
        // if selected one so other automatically disabled.
        zip_validate.readOnly = "true";
    }
}

