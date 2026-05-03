/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Form Image Cropper
 */

import Cropper from "cropperjs"
const small1 = "/images/stock/small-1.jpg"
;(function () {
    const DEFAULT_SRC = small1

    const fileInput = document.getElementById("fileInput")
    const useDemoBtn = document.getElementById("useDemoBtn")
    const clearInputBtn = document.getElementById("clearInputBtn")

    const image = document.getElementById("image")
    const cropBtn = document.getElementById("cropBtn")
    const downloadBtn = document.getElementById("downloadBtn")
    const croppedResult = document.getElementById("croppedResult")

    const zoomInBtn = document.getElementById("zoomInBtn")
    const zoomOutBtn = document.getElementById("zoomOutBtn")
    const rotateLeftBtn = document.getElementById("rotateLeftBtn")
    const rotateRightBtn = document.getElementById("rotateRightBtn")
    const resetBtn = document.getElementById("resetBtn")
    const aspect = document.getElementById("aspect")

    let cropper = null
    let objectUrl = null // track selected file blob URL

    function initCropper() {
        if (cropper) cropper.destroy()
        cropper = new Cropper(image, {
            viewMode: 1,
            dragMode: "move",
            preview: ".cropper-img-preview",
            autoCropArea: 0.8,
            responsive: true,
            background: false,
        })
    }

    // Load demo by default on page load
    window.addEventListener("load", () => {
        if (image.complete) initCropper()
        else image.onload = () => initCropper()
    })

    // When user selects a file -> override demo
    fileInput.addEventListener("change", (e) => {
        const f = e.target.files && e.target.files[0]
        if (!f) return // user canceled: keep current image (demo or previous)
        if (objectUrl) URL.revokeObjectURL(objectUrl)
        objectUrl = URL.createObjectURL(f)
        image.src = objectUrl
        image.onload = () => initCropper()
    })

    // Force use of demo image anytime
    useDemoBtn.addEventListener("click", () => {
        if (objectUrl) {
            URL.revokeObjectURL(objectUrl)
            objectUrl = null
        }
        image.src = DEFAULT_SRC
        // also clear file input UI (optional)
        fileInput.value = ""
        image.onload = () => initCropper()
    })

    // Clear only the file input control (keep whatever image is currently shown)
    clearInputBtn.addEventListener("click", () => {
        fileInput.value = ""
    })

    // Crop -> show result + enable download
    cropBtn.addEventListener("click", () => {
        if (!cropper) return
        const canvas = cropper.getCroppedCanvas({ width: 600, height: 600 })
        if (!canvas) return
        const dataURL = canvas.toDataURL("image/png")
        croppedResult.src = dataURL
        downloadBtn.href = dataURL
        downloadBtn.classList.remove("disabled")
    })

    // Controls
    zoomInBtn.addEventListener("click", () => cropper && cropper.zoom(0.1))
    zoomOutBtn.addEventListener("click", () => cropper && cropper.zoom(-0.1))
    rotateLeftBtn.addEventListener("click", () => cropper && cropper.rotate(-45))
    rotateRightBtn.addEventListener("click", () => cropper && cropper.rotate(45))
    resetBtn.addEventListener("click", () => cropper && cropper.reset())
    aspect.addEventListener("change", (e) => {
        if (!cropper) return
        const v = e.target.value
        const ratio = v === "NaN" ? NaN : Function("return " + v)()
        cropper.setAspectRatio(ratio)
    })

    // Cleanup blob URL when leaving page
    window.addEventListener("beforeunload", () => {
        if (objectUrl) URL.revokeObjectURL(objectUrl)
    })
})()
