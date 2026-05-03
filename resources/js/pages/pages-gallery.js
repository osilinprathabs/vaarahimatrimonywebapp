/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Pages Gallery
 */

import GLightbox from "glightbox"
import Muuri from "muuri"

//
// GLightbox
//
window.addEventListener("DOMContentLoaded", () => {
    GLightbox({
        selector: ".image-popup",
        title: false,
    })
})

//
// Muuri js
//
const gridElement = document.getElementById("grid")

if (gridElement) {
    let grid = new Muuri(gridElement, {
        dragEnabled: true,
        layout: { rounding: false, fillGaps: true },

        layoutOnResize: 150,
        layoutOnInit: true,
        layoutDuration: 300,
        layoutEasing: "ease",
    })

    if (grid) {
        // Search
        const searchInput = document.querySelector('input[name="search"]')
        if (searchInput) {
            searchInput.addEventListener("input", function (e) {
                const searchTerm = e.target.value.toLowerCase()
                grid.filter((item) => {
                    return item.getElement().textContent.toLowerCase().includes(searchTerm)
                })
            })
        }

        // Filter buttons
        const buttons = document.querySelectorAll(".filter-buttons button")
        if (buttons.length > 0) {
            buttons.forEach((button) => {
                button.addEventListener("click", () => {
                    const filter = button.dataset.filter

                    // Apply category filter
                    grid.filter((item) => {
                        const category = item.getElement().dataset.category
                        return !filter || category === filter
                    })

                    // Update active button styling
                    buttons.forEach((btn) => btn.classList.remove("active"))
                    button.classList.add("active")
                })
            })
        }
    }

    setTimeout(() => {
        grid.layout().refreshItems()
        grid.layout().synchronize()
    }, 150)
}
