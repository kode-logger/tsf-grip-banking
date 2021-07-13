function updateName() {
    let input = document.getElementById('name');
    let log = document.getElementById('name-display');

    input.oninput = handleInput;

    function handleInput(data) {
        if (data.target.value.length === 0)
            log.textContent = "Name";
        else
            log.textContent = data.target.value;
    }
}

function updateBalance() {
    let input = document.getElementById('balance');
    let log = document.getElementById('balance-display');

    input.oninput = handleInput;

    function handleInput(data) {
        if (data.target.value.length === 0)
            log.textContent = "Rs. 0";
        else
            log.textContent = "Rs. " + data.target.value;
    }
}

var rad = document.myForm.gender;
var prev = null;
for (var i = 0; i < rad.length; i++) {
    rad[i].addEventListener('change', function () {
        (prev) ? console.log(prev.value) : null;
        if (this !== prev) {
            prev = this;
        }
        if (this.value === 'Female') {
            document.getElementById("profile-icon").src = "../../static/img/female_profile_icon.svg";
            document.getElementById("gender-display").textContent = "Female";
        } else {
            document.getElementById("profile-icon").src = "../../static/img/male_profile_icon.svg";
            document.getElementById("gender-display").textContent = "Male";
        }
    });
}