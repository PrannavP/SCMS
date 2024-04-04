const addItemBtn = document.getElementById('openModalBtn');
const closeAddMenuButton = document.getElementById('closeAddBtn');

function addItem(){
    const addItemMenu = document.querySelector('.add-item-container');

    // set the addItemMenu display to flex so it gets seen
    addItemMenu.style.display = "flex";
};

function hideAddItemMenu(){
    // hide edit menu
    const addItemContainer = document.querySelector('.add-item-container');

    addItemContainer.style.display = "none";
};

addItemBtn.addEventListener('click', addItem);
closeAddMenuButton.addEventListener('click', hideAddItemMenu);