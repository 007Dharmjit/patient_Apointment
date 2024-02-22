const searchInput = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");
let timeoutId;

// Sample list of names (you can replace with your own data)
const names = [
  "Visnagar",
  "Keralu",
  "Satlasana",
  "Vijapur",
  "Unja",
  "Kadi",
  "Vadnagar",
  "Mehsana",
  "Bechraji"
];

searchInput.addEventListener("input", (e) => {
  const query = e.target.value.toLowerCase();
  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => {
    if (query.length > 0) {
      const filteredNames = names.filter((name) =>
        name.toLowerCase().includes(query)
      );

      suggestions.innerHTML = "";
      if (filteredNames.length > 0) {
        filteredNames.forEach((name) => {
          const suggestionItem = document.createElement("div");
          suggestionItem.classList.add("suggestions-item");
          suggestionItem.textContent = name;
          suggestionItem.addEventListener("click", () => {
            searchInput.value = name;
            suggestions.innerHTML = "";
          });
          suggestions.appendChild(suggestionItem);
        });
        suggestions.style.display = "block";
      } else {
        suggestions.style.display = "";
      }
    } else {
      suggestions.innerHTML = "";
      suggestions.style.display = "none";
    }
  }, 300);
});

searchInput.addEventListener("blur", () => {
  if (!searchInput.value.trim()) {
    suggestions.innerHTML = "";
    suggestions.style.display = "none";
  }
});

function selectedcity(){
    document.getElementById('city').value = searchInput.value;
}