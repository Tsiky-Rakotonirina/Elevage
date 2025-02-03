
document.addEventListener("DOMContentLoaded", () => {
  const daysContainer = document.getElementById("days");
  const monthSelect = document.getElementById("month-select");
  const yearSelect = document.getElementById("year-select");
  const info = document.getElementById("info");
  const dateInput = document.getElementById("selected-date");
  const form = document.getElementById("date-form");

  const months = [
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
  ];

  const today = new Date();
  let currentMonth = today.getMonth();
  let currentYear = today.getFullYear();

  months.forEach((month, index) => {
    const option = document.createElement("option");
    option.value = index;
    option.textContent = month;
    if (index === currentMonth) option.selected = true;
    monthSelect.appendChild(option);
  });

  for (let year = currentYear - 10; year <= currentYear + 10; year++) {
    const option = document.createElement("option");
    option.value = year;
    option.textContent = year;
    if (year === currentYear) option.selected = true;
    yearSelect.appendChild(option);
  }

  function generateCalendar(month, year) {
    daysContainer.innerHTML = "";

    const dayNames = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];
    dayNames.forEach(day => {
      const dayNameElement = document.createElement("div");
      dayNameElement.className = "day-name";
      dayNameElement.textContent = day;
      daysContainer.appendChild(dayNameElement);
    });

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const adjustedFirstDay = (firstDay === 0) ? 7 : firstDay;

    for (let i = 1; i < adjustedFirstDay; i++) {
      const emptyDay = document.createElement("div");
      emptyDay.className = "day empty";
      daysContainer.appendChild(emptyDay);
    }

    let selectedDayElement = null; // Variable to keep track of the selected day

    for (let day = 1; day <= daysInMonth; day++) {
      const dayElement = document.createElement("div");
      dayElement.className = "day";
      dayElement.textContent = day;

      dayElement.addEventListener("click", () => {
        // Remove the selected class from the previously selected day
        if (selectedDayElement) {
          selectedDayElement.classList.remove("selected");
        }

        // Add the selected class to the clicked day
        dayElement.classList.add("selected");
        selectedDayElement = dayElement;

        const clickedDate = new Date(year, month, day);
        const formattedDate = `${year}-${month + 1}-${day}`;

        dateInput.value = formattedDate; // Fill the hidden input field
        info.textContent = `Date cliquée : ${formattedDate}`;
        form.submit(); // Automatically submit the form
      });

      daysContainer.appendChild(dayElement);
    }
  }

  monthSelect.addEventListener("change", () => {
    currentMonth = parseInt(monthSelect.value);
    generateCalendar(currentMonth, currentYear);
  });

  yearSelect.addEventListener("change", () => {
    currentYear = parseInt(yearSelect.value);
    generateCalendar(currentMonth, currentYear);
  });

  generateCalendar(currentMonth, currentYear);
});
