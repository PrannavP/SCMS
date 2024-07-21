document.addEventListener('DOMContentLoaded', function() {
    const addMoreBtn = document.getElementById('addMore');
    const partsContainer = document.getElementById('partsContainer');
    const form = document.getElementById('updateForm');
    const totalValue = document.getElementById('totalValue');
    const requestedBySelect = document.getElementById('requested_by');
    const existingPartsList = document.getElementById('existingPartsList');
    const currentTotalDiv = document.getElementById('currentTotal');

    let currentTotal = 0;

    const popup = document.getElementById('popup');

    function showPopup() {
        popup.classList.add('show');
        setTimeout(() => {
            popup.classList.remove('show');
        }, 2000); // Hide after 2 seconds
    }

    function updatePrice() {
        const parts = document.querySelectorAll('.parts');
        const selectedParts = Array.from(parts).map(select => select.value).filter(value => value !== "");

        fetch('get_price.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ parts: selectedParts })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.totalPrice !== undefined) {
                currentTotal = data.totalPrice;
                totalValue.textContent = currentTotal.toFixed(2);
                currentTotalDiv.style.display = 'block'; // Show the total price
                // showPopup();
            } else {
                throw new Error('Unexpected response format');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function resetAddedParts() {
        const partSelects = partsContainer.querySelectorAll('.parts');
        for (let i = 1; i < partSelects.length; i++) {
            partSelects[i].remove();
        }
        partSelects[0].value = '';
        
        currentTotal = 0;
        totalValue.textContent = '0.00';
        currentTotalDiv.style.display = 'none';
    }

    function getExistingParts() {
        const requestedBy = requestedBySelect.value;
        if (!requestedBy) {
            existingPartsList.innerHTML = '';
            currentTotalDiv.style.display = 'none';
            resetAddedParts();
            return;
        }

        fetch('get_existing_parts.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ requested_by: requestedBy })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            existingPartsList.innerHTML = '';
            if (data.parts) {
                const parts = data.parts.split(', ');
                parts.forEach(part => {
                    const li = document.createElement('li');
                    li.textContent = part;
                    existingPartsList.appendChild(li);
                });
            }
            currentTotalDiv.style.display = 'none';
            resetAddedParts();
        })
        .catch(error => {
            console.error('Error:', error);
            existingPartsList.innerHTML = '<li>Error fetching existing parts</li>';
            resetAddedParts();
        });
    }

    requestedBySelect.addEventListener('change', getExistingParts);

    addMoreBtn.addEventListener('click', function() {
        const newSelect = document.createElement('select');
        newSelect.className = 'parts';
        newSelect.name = 'parts[]';
        newSelect.innerHTML = partsContainer.querySelector('.parts').innerHTML;
        partsContainer.appendChild(newSelect);
        newSelect.addEventListener('change', updatePrice);
        // showPopup();
    });

    partsContainer.addEventListener('change', updatePrice);

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append('totalPrice', currentTotal);
        
        fetch('update_parts_and_price.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(result => {
            if (result.error) {
                throw new Error(result.error);
            }
            alert(result.message);
            
            existingPartsList.innerHTML = '';
            const updatedParts = result.parts.split(', ');
            updatedParts.forEach(part => {
                const li = document.createElement('li');
                li.textContent = part;
                existingPartsList.appendChild(li);
            });
    
            resetAddedParts();
    
            currentTotal = parseFloat(result.amount);
            totalValue.textContent = currentTotal.toFixed(2);
            currentTotalDiv.style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating parts and price: ' + error.message);
        });
    });

    currentTotalDiv.style.display = 'none';
});