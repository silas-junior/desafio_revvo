async function fetchCursos() {
   const response = await fetch("/api/courses");
   const courses = await response.json();

   const list = document.getElementById("course-list");
   list.innerHTML = "";
   courses.forEach(course => {
       const li = document.createElement("li");
       li.textContent = course.title;
       list.appendChild(li);
   });
}