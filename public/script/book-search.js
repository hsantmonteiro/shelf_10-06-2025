document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("book-search");
    const suggestionsContainer = document.getElementById("search-suggestions");
    const searchForm = document.getElementById("book-search-form");
    let debounceTimer;

    // Initialize with current search value
    const urlParams = new URLSearchParams(window.location.search);
    const currentSearch = urlParams.get("search") || "";
    searchInput.value = currentSearch;

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

    searchInput.addEventListener("focus", function () {
        if (
            this.value.trim().length >= 2 &&
            suggestionsContainer.innerHTML !== ""
        ) {
            suggestionsContainer.style.display = "block";
        }
    });

    suggestionsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("search-suggestion-item")) {
            searchInput.value = e.target.dataset.title || e.target.textContent;
            suggestionsContainer.style.display = "none";

            // Update the URL without submitting the form
            updateUrlSearchParam(searchInput.value);

            // Submit the form to refresh results
            searchForm.submit();
        }
    });

    document.addEventListener("click", function (e) {
        if (
            e.target !== searchInput &&
            !e.target.closest(".search-suggestions")
        ) {
            suggestionsContainer.style.display = "none";
        }
    });

    // Function to update URL search parameter
    function updateUrlSearchParam(searchValue) {
        const url = new URL(window.location.href);
        url.searchParams.set("search", searchValue);
        window.history.pushState({}, "", url);
    }

    // function fetchSuggestions(query) {
    //     const pathParts = window.location.pathname.split("/");
    //     const libraryHandle = pathParts[1];

    //     fetch(
    //         `/${libraryHandle}/autocomplete-books?query=${encodeURIComponent(
    //             query
    //         )}`
    //     )
    //         .then((response) => response.json())
    //         .then((data) => {
    //             if (data.length > 0) {
    //                 suggestionsContainer.innerHTML = data
    //                     .map(
    //                         (item) => `
    //                     <div class="search-suggestion-item"
    //                          data-title="${item.title}"
    //                          data-id="${item.id}">
    //                         <strong class="fw-bold margin-bottom-400">${item.title}</strong>
    //                         <div class="fw-regular fc-neutral-400 fs-100">
    //                             <span>${item.author}</span>
    //                             ${
    //                                 item.subjects
    //                                     ? `<span>• ${item.subjects}</span>`
    //                                     : ""
    //                             }
    //                         </div>
    //                     </div>
    //                 `
    //                     )
    //                     .join("");
    //                 suggestionsContainer.style.display = "block";
    //             } else {
    //                 suggestionsContainer.style.display = "none";
    //             }
    //         })
    //         .catch((error) => {
    //             console.error("Error fetching suggestions:", error);
    //             suggestionsContainer.style.display = "none";
    //         });
    // }

    function fetchSuggestions(query) {
        const pathParts = window.location.pathname.split("/");
        const libraryHandle = pathParts[1];

        fetch(
            `/${libraryHandle}/autocomplete-books?query=${encodeURIComponent(
                query
            )}`
        )
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    suggestionsContainer.innerHTML = data
                        .map(
                            (item) => `
                    <div class="search-suggestion-item" 
                         data-title="${item.title}"
                         data-id="${item.id}">
                        <strong class="fw-bold margin-bottom-400">${
                            item.title
                        }</strong>
                        <div class="fw-regular fc-neutral-400 fs-100">
                            ${item.author ? `<span>${item.author}</span>` : ""}
                            ${
                                item.subjects
                                    ? `<span>• ${item.subjects}</span>`
                                    : ""
                            }
                        </div>
                    </div>
                `
                        )
                        .join("");
                    suggestionsContainer.style.display = "block";
                } else {
                    suggestionsContainer.style.display = "none";
                }
            })
            .catch((error) => {
                console.error("Error fetching suggestions:", error);
                suggestionsContainer.style.display = "none";
            });
    }

    // Handle browser back/forward buttons
    window.addEventListener("popstate", function () {
        const urlParams = new URLSearchParams(window.location.search);
        searchInput.value = urlParams.get("search") || "";
        if (searchInput.value) {
            searchForm.submit();
        }
    });
});
