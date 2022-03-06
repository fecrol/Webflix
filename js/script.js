function fillExpiryMonths() {
    var selectElement = document.getElementById("expMonth");

    for(let i=1; i<=12; i++) {
        var option = document.createElement("option");
        option.value = i;
        option.innerHTML = i;
        selectElement.appendChild(option);
    }
}

function addZeroIfNumLessThan10(num) {
    var newNum;
    
    if(num < 10) {
        newNum = "0" + num;
        return newNum;
    }

    return num;
}

function fillExpiryYears() {
    for(let i=1; i<=10; i++) {
        
    }
}