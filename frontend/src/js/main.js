window.addEventListener('load', function(event) {
    if(!this.window.localStorage.getItem('first_access')) {
        this.window.localStorage.setItem('first_access', true);

        showModal('modal_new_course');
    }
})

function showModal(modal_id) {
    let modal = document.getElementById(`${modal_id}`);

    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function closeModal(modal_id) {
    let modal = document.getElementById(`${modal_id}`);

    modal.style.display = "none";

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

async function fetchCursos() {
   const response = await fetch("/api/courses");
   const courses = await response.json();

   const list = document.getElementById("list_courses");
   list.innerHTML = "";
   courses.forEach(course => {
       const li = document.createElement("li");
       li.textContent = course.title;
       list.appendChild(li);
   });
}