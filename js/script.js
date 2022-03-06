function createOptionElement(value, innerHTML) {
    var option = document.createElement("option");
    option.value = value;
    option.innerHTML = innerHTML;

    return option;
}

function addZeroIfNumLessThan10(num) {
    if(num < 10) {
        num = "0" + num;
    }

    return num;
}

function fillExpiryMonths() {
    /*
    Fills in the expiry months select menu on registration page
    to allow user to select options 
    */

    var selectElement = document.getElementById("expMonthOpt");

    for(let i=1; i<=12; i++) {
        var option = createOptionElement(i, addZeroIfNumLessThan10(i));
        
        selectElement.appendChild(option);
    }
}

function getCurrentYear() {
    var currentTime = new Date();
    var currentYear = currentTime.getUTCFullYear();

    return currentYear;
}

function fillExpiryYears() {
    /*
    Fills in the expiry year select menu on registration page
    to allow user to select options 
    */

    var year = getCurrentYear();
    var selectElement = document.getElementById("expYearOpt");

    for(let i=0; i<=4; i++) {
        var option = createOptionElement(year + i, year + i);
        selectElement.appendChild(option)
    }
}