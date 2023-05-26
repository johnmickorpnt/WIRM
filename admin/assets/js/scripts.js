
document.addEventListener("DOMContentLoaded", function () {
    let modals = document.querySelectorAll(".modal");
    let modalBtns = document.querySelectorAll(".action-button");

    modalBtns.forEach(btn => {
        if (!btn.hasAttribute("target-modal")) return false;
        let targetModal = btn.getAttribute("target-modal");
        btn.addEventListener("click", () => {
            console.log(targetModal);
            document.getElementById(targetModal).showModal();
            document.getElementById(targetModal).classList.add("open");

            if (!btn.hasAttribute('data-function')) return false;
            const functionName = btn.getAttribute('data-function');
            const targetForm = btn.getAttribute('target-form');
            const targetId = btn.getAttribute('target-id') || null;

            if (typeof window[functionName] === 'function') {
                showLoadingSpinner(`#${targetModal} .loading`); // Show loading spinner
                const promise = new Promise((resolve, reject) => {
                    window[functionName](targetForm, targetId); // Call the function
                    resolve(); // Resolve the promise immediately after the function call
                });

                promise
                    .then(() => {
                        return new Promise(resolve => setTimeout(resolve, 500)); // Introduce a 0.5-second delay
                    })
                    .then(() => {
                        hideLoadingSpinner(`#${targetModal} .loading`); // Hide loading spinner after the delay
                        console.log('Function execution complete');
                    })
                    .catch(error => {
                        hideLoadingSpinner(`#${targetModal} .loading`); // Hide loading spinner in case of an error
                        console.error('Error executing function:', error);
                    });
            } else console.error('Function not found');
        });
    });

    modals.forEach(modal => {
        let closeModalBtn = modal.querySelector(".close-modal");
        // Add close button foreach modals
        closeModalBtn.addEventListener("click", () => {
            modal.classList.remove("open");
            modal.close();
            showLoadingSpinner('.loading');
        });
    });
    flatpickr(".datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i:s",
        altInput: true,
        altFormat: "F j, Y H:i:s",
        static: true
        // Additional options...
    });
});

var fetch_users = () => {
    return fetch('php/functions/user/read.php')
        .then(res => res.json())
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error:', error);
        });
}

var fetch_rooms = () => {
    return fetch('php/functions/room/read.php')
        .then(res => res.json())
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error:', error);
        });
}

var fetch_reservation = (id) => {
    var params = new URLSearchParams();
    params.append("reservation_id", id);

    return fetch('php/functions/reservation/read.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .catch(error => {
            console.error('Error:', error);
        });
}

function delete_row(id, table) {
    let conf = confirm("Are you sure to delete this row?");
    var params = new URLSearchParams();
    params.append("id", id);
    params.append("table", table);

    if (!conf) return;
    fetch('php/functions/delete.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .finally(() => location.reload())
        .catch(error => {
            alert('Error:', error);
        });
}

var fetch_user = (id) => {
    var params = new URLSearchParams();
    params.append("user_id", id);

    return fetch('php/functions/user/read.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .catch(error => {
            console.error('Error:', error);
        });
}


function showLoadingSpinner(classElement) {
    // Show loading spinner logic here
    let element = document.querySelector(classElement);
    element.style.opacity = 1;
    element.style.visibility = "visible";
}

function hideLoadingSpinner(classElement) {
    // Hide loading spinner logic here
    let element = document.querySelector(classElement);
    element.style.opacity = 0;
    element.style.visibility = "hidden";
}


/**
 * @param  {int} ms the milisecond on how long should it sleep
 */
function timeout(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
/**
 * @param  {int} ms
 * @param  {callback} fn
 * @param  {arguments} ...args
 */
async function sleep(ms, fn, ...args) {
    await timeout(ms);
    return fn(...args);
}
