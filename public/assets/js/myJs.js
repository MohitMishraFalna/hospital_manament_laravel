// ALERT REMOVE.
setTimeout(() => {
    // This method only hide the div but dont remove.
    // document.getElementsByClassName("alert")[0].classList.remove("show");
    // This method do also only div visibility none do not remove.
    // document.getElementsByClassName("alert")[0].style.display = "none";
    // This method remove div from dom.
    document.getElementsByClassName("alert")[0].remove();
}, 3000);

// SPINNER.
document.getElementsByClassName("submit")[0].addEventListener("click", function (e) {
    let form = document.forms["form_validation"];
    if(form["name"] == "" || form["email"].value == "" || form["phone"].value == "" || form["image"].value == "" || form["block"].value == "" || form["district"].value == "" || form["region"].value == "" || form["state"].value == "" || form["contry"].value == "" || form["age"].value == ""){
        e.preventDefault();
        return 0;
    }
    document.getElementsByClassName("bodyCover")[0].style.display = "";
})

// Ajax method call for user address using blur out method.
document.getElementsByName("zip")[0].addEventListener('blur', getAdresWithApi); 
document.getElementsByName("post_name")[0].addEventListener('blur', getAdresWithApi); 

function getAdresWithApi(e) {
    // Spinner display on.
    document.getElementsByClassName("bodyCover")[0].style.display = "";


    // Get data from the form.
    let csrf_token = document.getElementsByName("_token")[0].value;
    let zip = zip_validate.value;
    let postName = string_validate.value;
    /* every object contain a empty string which mean this empty string handle "if" condition in controller for double function*/
    let data = (zip != "") ? {"zip_data":zip, "postName":""}: {"postName":postName, "zip_data":""}
    let stringfyData = JSON.stringify(data);

    // Create url.
    let url = "http://127.0.0.1:8000/common/address";

    // Create object for the Ajax request using XMLHttpRequest() method.
    let xhr = new XMLHttpRequest();

    // Create url using open() method.
    xhr.open("POST", url, false);

    // set request header like json, text etc.
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrf_token);

    // Get respone using this function.
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            // When response will come then spinner display none.
            document.getElementsByClassName("bodyCover")[0].style.display = "none";

            let response = JSON.parse(xhr.responseText);
            if(response[0].Status == "Success"){
                response[0].PostOffice.forEach(element => {
                    console.log(element);
                    document.getElementsByName("zip")[0].value = element.Pincode;
                    document.getElementsByName("block")[0].value = element.Block;
                    document.getElementsByName("district")[0].value = element.District;
                    document.getElementsByName("region")[0].value = element.Region;
                    document.getElementsByName("state")[0].value = element.State;
                    document.getElementsByName("contry")[0].value = element.Country;

                    let option = document.createElement("option");
                    option.value = element.Name;
                    option.innerText = element.Name;
                    document.getElementsByName("city")[0].appendChild(option);
                });
            }else{
                // If error message recieved so city input convert from select tag to input tag.
                document.getElementsByName("city")[0].remove();
                document.getElementById("city").innerHTML = '<input type="text" class="form-control city" name="city" placeholder="City"/>';

                // Error message show and remove here...
                document.getElementsByClassName("apiError")[0].style.display = "";
                document.getElementsByClassName("apiError")[0].innerHTML = response[0].Message;
                setTimeout(() => {
                    document.getElementsByClassName("alert")[0].remove();
                    document.getElementsByClassName("apiError")[0].style.display = "none";
                }, 4000);
            }
        }
    }

    // send request with the data
    /*
        when we use post method so it required to send data using send method like below.
        and we use get method so it is not compulsory. 
    */
    xhr.send("data="+stringfyData);
}