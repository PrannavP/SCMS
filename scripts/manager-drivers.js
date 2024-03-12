// show and hide edit menu

const editButtts = document.querySelectorAll('.editBtn');
const closedEditMenuButton = document.getElementById('closeEditBtn');;

function showEditMenu(id, fullname, contactnumber, licensenumber){
    const editMenuContainer = document.querySelector('.edit-driver-container') ;

    // selecting input frorm elements
    const idInput = document.getElementById('driverid');
    const nameInput = document.getElementById('fullname');
    const contactNumberInput = document.getElementById('contactnumber');
    const licenseNumberInput = document.getElementById('licensenumber');
    // const licenseExpiryDateInput = document.getElementById('licenseexpiry');

    idInput.value = id;
    nameInput.value = fullname;
    contactNumberInput.value = contactnumber;
    licenseNumberInput.value = licensenumber;

    console.log(id, fullname, contactnumber, licensenumber);

    // set the editMenuContainer display to flex so it gets seen
    editMenuContainer.style.display = "flex";
    
};

function hideEditMenu(){
    // hide the edit menu
    const editMenuContainer = document.querySelector('.edit-driver-container');

    editMenuContainer.style.display = "none";
};

closedEditMenuButton.addEventListener('click', hideEditMenu);