const dateTimeElement = document.getElementById('datejoined');

function showDefaultTimeAndDate(datetimeelement){
    const now = new Date();

    // Get the time zone offset in minutes
    const timezoneOffset = now.getTimezoneOffset();
        
    // Adjust the current date and time by the time zone offset
    now.setMinutes(now.getMinutes() - timezoneOffset);

    const formattedDateTime = now.toISOString().slice(0, 16);

    // console.log(formattedDateTime);

    datetimeelement.value = formattedDateTime;
};

// showDefaultTimeAndDate(dateTimeElement);


// show and hide edit menu

const editButtons = document.querySelectorAll(".editBtn");
const closeEditMenuButton = document.getElementById("closeEditBtn");

function showEditMenu(id, fullname, contactnumber, address){
    const editMenuContainer = document.querySelector('.edit-mechanic-container');

    // selecting all other elements and setting it's display to none
    const mechanicsTable = document.querySelector('.mechanics');
    const userProfile = document.querySelector('.user-profile');
    const sideNavigationBar = document.querySelector('aside');
    const header = document.querySelector('header');

    // changing the display
    // mechanicsTable.style.display = "none";
    // userProfile.style.display = "none";
    // sideNavigationBar.style.display = "none";
    // header.style.display = "none";

    // selecting input form elements
    const idInput = document.getElementById('mechanicid');
    const nameInput = document.getElementById('fullname');
    const contactInput = document.getElementById('contactnumber');
    const addressInput = document.getElementById('address');    

    // setting the default value of input fields according to their row datas
    idInput.value = id;
    nameInput.value = fullname;
    contactInput.value = contactnumber;
    addressInput.value = address;

    console.log(id, fullname, contactnumber, address);

    // set the editMenuContainer display to flex so it gets seen
    editMenuContainer.style.display = "flex";

    // document.querySelector('body').style.backgroundColor = "background-color: rgba(0, 0, 0, 0.5)";
};


function hideEditMenu(closeeditbtn){
    // hide the edit menu
    const editMenuContainer = document.querySelector('.edit-mechanic-container');

    editMenuContainer.style.display = "none";
};

closeEditMenuButton.addEventListener('click', hideEditMenu);


// show / hide add mechanics button
const addMechanicButton = document.getElementById('openModalBtn');
let addMechanicContainer = document.querySelector('.add-mechanic-container');
const closeMechanicContainer = document.getElementById('closeAddBtn');

function showAddMechanicForm(){
    addMechanicContainer.style.display = "flex";
};

function closeAddMechanicForm(){
    addMechanicContainer.style.display = "none";
};

addMechanicButton.addEventListener('click', showAddMechanicForm);
closeMechanicContainer.addEventListener('click', closeAddMechanicForm);