// setting default date input
function inputDateFix(){
    // Get the current date in the format "YYYY-MM-DD"
    const currentDate = new Date().toISOString().split('T')[0];

    // Set the value of the date input to the current date
    document.getElementById('date').value = currentDate;
};

inputDateFix();

// disable input fields depending on checkboxes
function disableAddressBoxIfNotCheckedBox(){
    // getting checkboxes from html
    const pickupCheckBox = document.getElementById('pickup-chkbox');
    const deliveryCheckBox = document.getElementById('delivery-chkbox');

    // getting textfields from html
    const pickupAddressField = document.getElementById('pickup-address');
    const deliveryAddressField = document.getElementById('delivery-address');

    // adding event listener to the checkboxes
    pickupCheckBox.addEventListener('change', function(){
        // if the checkbox is checked then enable the input field otherwise disable it
        pickupAddressField.disabled = !pickupCheckBox.checked;
    });

    deliveryCheckBox.addEventListener('change', function(){
        // if the checkbox is checked then enable the input field otherwise disable it
        deliveryAddressField.disabled = !deliveryCheckBox.checked;
    });
};

disableAddressBoxIfNotCheckedBox();