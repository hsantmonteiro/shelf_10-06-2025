document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("library-search");
    const suggestionsContainer = document.getElementById("search-suggestions");
    let debounceTimer;

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);

        const query = this.value.trim();

        if (query.length < 2) {
            suggestionsContainer.style.display = "none";
            return;
        }

        debounceTimer = setTimeout(() => {
            fetchSuggestions(query);
        }, 300);
    });

    suggestionsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("search-suggestion-item")) {
            searchInput.value = e.target.textContent;
            suggestionsContainer.style.display = "none";
            document.getElementById("library-search-form").submit();
        }
    });

    document.addEventListener("click", function (e) {
        if (e.target !== searchInput) {
            suggestionsContainer.style.display = "none";
        }
    });

    function fetchSuggestions(query) {
        fetch(`/autocomplete-libraries?query=${encodeURIComponent(query)}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    suggestionsContainer.innerHTML = "";
                    data.forEach((item) => {
                        const suggestion = document.createElement("div");
                        suggestion.className = "search-suggestion-item";
                        suggestion.textContent = item.nm_biblioteca;
                        suggestion.dataset.id = item.id_biblioteca;
                        suggestionsContainer.appendChild(suggestion);
                    });
                    suggestionsContainer.style.display = "block";
                } else {
                    suggestionsContainer.style.display = "none";
                }
            });
    }
});
