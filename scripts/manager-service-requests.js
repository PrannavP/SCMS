const accpetRequestBtn = document.getElementById('acceptButton');
const closedEditMenuButton = document.getElementById('closeEditBtn');
const seeDetailsButton = document.getElementById('viewDetailsButton');
const closeDetailsBtn = document.getElementById('details-closeDetailstBtn');

function openAcceptModal(id, details, amount){
    const editMenuContainer = document.querySelector('.confirm-service-container');

    let requestIDField = document.getElementById('request_id');
    let requestDetailsField = document.getElementById('customer-servicing-detail');
    let amountField = document.getElementById('amount');
    
    requestDetailsField.value = details;
    requestIDField.value = id;
    amountField.value = amount;

    // set the editMenuContainer display to flex so it gets seen
    editMenuContainer.style.display = "flex";
};

function openDetailsModal(id, details, amount, status, parts){
    const detailsMenuContainer = document.querySelector('.details-service-container');

    let requestIDField = document.getElementById('details-request_id');
    let requestDetailsField = document.getElementById('details-customer-servicing-detail');
    let amountField = document.getElementById('details-amount');
    let servicingStatusField = document.getElementById('details-servicing_status');
    let partsField = document.getElementById('details-parts');
    
    requestDetailsField.value = details;
    requestIDField.value = id;
    amountField.value = amount;
    servicingStatusField.value = status;
    partsField.value = parts;

    // set the editMenuContainer display to flex so it gets seen
    detailsMenuContainer.style.display = "flex";
};


function hideEditMenu(){
    // hide the edit menu
    const editMenuContainer = document.querySelector('.confirm-service-container');

    editMenuContainer.style.display = "none";
    // console.log('closed');
};

function hideDetailsMenu(){
    const detailsMenuContainer = document.querySelector('.details-service-container');

    detailsMenuContainer.style.display = "none";
};


closedEditMenuButton.addEventListener('click', hideEditMenu);
closeDetailsBtn.addEventListener('click', hideDetailsMenu);