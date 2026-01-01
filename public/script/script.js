document.addEventListener("DOMContentLoaded", function () {
    // Menu Toggle (Sidebar)
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const primarySidebar = document.querySelector(".primary-sidebar");
    const closeMenu = document.querySelector(".close-menu");
    const sidebarOverlay = document.getElementById("primary-sidebar__overlay");

    if (sidebarToggle && primarySidebar && closeMenu && sidebarOverlay) {
        const savedVisibleState =
            localStorage.getItem("sidebarVisible") === "true";
        primarySidebar.setAttribute("data-visible", savedVisibleState);
        sidebarToggle.setAttribute("aria-expanded", savedVisibleState);

        sidebarToggle.addEventListener("click", () => {
            const visible =
                primarySidebar.getAttribute("data-visible") === "true";
            const newState = !visible;

            primarySidebar.setAttribute("data-visible", newState);
            sidebarToggle.setAttribute("aria-expanded", newState);
            sidebarOverlay.classList.add("active");

            localStorage.setItem("sidebarVisible", newState);
        });

        closeMenu.addEventListener("click", () => {
            primarySidebar.setAttribute("data-visible", "false");
            sidebarToggle.setAttribute("aria-expanded", "false");
            sidebarOverlay.classList.remove("active");

            localStorage.setItem("sidebarVisible", false);
        });

        sidebarOverlay.addEventListener("click", () => {
            primarySidebar.setAttribute("data-visible", "false");
            sidebarToggle.setAttribute("aria-expanded", "false");
            sidebarOverlay.classList.remove("active");

            localStorage.setItem("sidebarVisible", false);
        });

        const checkScreenWidth = () => {
            if (window.matchMedia("(max-width: 58.74em)").matches) {
                sidebarOverlay.classList.remove("active");
            }
        };

        checkScreenWidth();

        window.addEventListener("resize", checkScreenWidth);
    }

    // Menu Button (Nav)
    const menuBtn = document.querySelector(".menu-btn");
    const primaryNav = document.querySelector(".primary-header__nav");
    const overlay = document.getElementById("primary-header__overlay");
    const body = document.body;

    if (menuBtn && primaryNav && overlay) {
        menuBtn.addEventListener("click", () => {
            const visible = primaryNav.getAttribute("data-visible");
            if (visible === "false") {
                primaryNav.setAttribute("data-visible", "true");
                menuBtn.setAttribute("aria-expanded", "true");
                overlay.classList.add("active");
                body.classList.add("active");
            } else {
                primaryNav.setAttribute("data-visible", "false");
                menuBtn.setAttribute("aria-expanded", "false");
                overlay.classList.remove("active");
                body.classList.remove("active");
            }
        });

        overlay.addEventListener("click", () => {
            primaryNav.setAttribute("data-visible", "false");
            menuBtn.setAttribute("aria-expanded", "false");
            overlay.classList.remove("active");
            body.style.overflowY = "auto";
        });
    }

    // Price Toggle
    const monthlyInput = document.getElementById("monthly");
    const annualInput = document.getElementById("annual");
    const price = document.querySelector(".price-text");
    const frequency = document.querySelector(".frequency-text");

    if (monthlyInput && annualInput && price && frequency) {
        const priceMonthly = "24,99";
        const priceAnnual = "123,45";

        function changePrice() {
            if (annualInput.checked) {
                price.innerHTML = priceAnnual;
                frequency.innerHTML = "/ano";
            } else if (monthlyInput.checked) {
                price.innerHTML = priceMonthly;
                frequency.innerHTML = "/mês";
            }
        }

        monthlyInput.addEventListener("change", changePrice);
        annualInput.addEventListener("change", changePrice);
        changePrice();
    }

    // Dropdown
    const dropdownBtns = document.querySelectorAll(".dropdown__btn");
    const dropdownContents = document.querySelectorAll(".dropdown__content");

    if (dropdownBtns.length && dropdownContents.length) {
        dropdownBtns.forEach((btn, index) => {
            btn.addEventListener("click", function (e) {
                e.stopPropagation();
                dropdownContents[index].classList.toggle(
                    "dropdown__content--show"
                );
            });
        });

        window.addEventListener("click", function (e) {
            if (!e.target.closest(".dropdown")) {
                dropdownContents.forEach((content) => {
                    content.classList.remove("dropdown__content--show");
                });
            }
        });
    }

    // Modal
    document.querySelectorAll(".open-modal").forEach((openBtn) => {
        const target = openBtn.dataset.open;
        const modalWrapper = document.querySelector(
            `.modal-wrapper[data-modal="${target}"]`
        );
        const modal = modalWrapper?.querySelector(".modal");

        const closeBtns = modalWrapper?.querySelectorAll(
            `.close-modal[data-close="${target}"], .btn--cancel`
        );

        if (modalWrapper && modal && closeBtns) {
            openBtn.addEventListener("click", () => {
                modalWrapper.classList.add("open");

                // Add ESC key event when modal opens
                const escHandler = (e) => {
                    if (e.key === "Escape") {
                        modalWrapper.classList.remove("open");
                        document.removeEventListener("keydown", escHandler);
                    }
                };

                document.addEventListener("keydown", escHandler);
            });

            closeBtns.forEach((closeBtn) => {
                closeBtn.addEventListener("click", () => {
                    modalWrapper.classList.remove("open");
                });
            });

            modalWrapper.addEventListener("mousedown", (e) => {
                if (!modal.contains(e.target)) {
                    modalWrapper.classList.remove("open");
                }
            });
        }
    });

    // Handle delete confirmation
    // Handle delete confirmation
    // const confirmDeleteBtn = document.getElementById("confirm-delete-btn");
    // if (confirmDeleteBtn) {
    //     confirmDeleteBtn.addEventListener("click", async () => {
    //         const modalWrapper = document.querySelector(
    //             '.modal-wrapper[data-modal="confirm-delete"].open'
    //         );
    //         if (modalWrapper && modalWrapper.dataset.formId) {
    //             const form = document.getElementById(
    //                 modalWrapper.dataset.formId
    //             );

    //             if (form) {
    //                 try {
    //                     const response = await fetch(form.action, {
    //                         method: "POST",
    //                         headers: {
    //                             "Content-Type": "application/json",
    //                             "X-CSRF-TOKEN": document.querySelector(
    //                                 'meta[name="csrf-token"]'
    //                             ).content,
    //                         },
    //                         body: JSON.stringify({
    //                             _method: "DELETE",
    //                         }),
    //                     });

    //                     const result = await response.json();

    //                     if (response.ok) {
    //                         // Redirect to library books page
    //                         window.location.href = result.redirect;
    //                     } else {
    //                         alert(
    //                             "Erro ao excluir livro: " +
    //                                 (result.message || "Erro desconhecido")
    //                         );
    //                     }
    //                 } catch (error) {
    //                     alert("Erro na requisição: " + error.message);
    //                 }
    //             }
    //         }
    //         modalWrapper.classList.remove("open");
    //     });
    // }

    //Inserção de Imagens

    const fileUpload = document.getElementById("file-upload");
    const removeImageBtn = document.getElementById("remove-image");
    const imagePreview = document.getElementById("image-preview");
    const imagePreviewContainer = document.getElementById(
        "image-preview-container"
    );
    const currentImage = document.getElementById("current-image");

    if (fileUpload) {
        fileUpload.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                // Update the text
                document.querySelector(".file-upload").textContent = file.name;

                // Show preview if elements exist
                if (imagePreview && imagePreviewContainer) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        imagePreview.src = event.target.result;
                        imagePreviewContainer.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                }

                // Show remove button
                if (removeImageBtn) {
                    removeImageBtn.style.display = "block";
                }

                currentImage.style.display = "none";
            }
        });

        if (removeImageBtn) {
            removeImageBtn.addEventListener("click", function () {
                fileUpload.value = "";
                document.querySelector(".file-upload").textContent =
                    "Inserir imagem";
                this.style.display = "none";

                // Hide preview if exists
                if (imagePreviewContainer) {
                    imagePreviewContainer.style.display = "none";
                }

                currentImage.style.display = "block";
            });
        }
    }
});
