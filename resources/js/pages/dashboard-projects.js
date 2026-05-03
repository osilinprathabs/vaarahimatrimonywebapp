/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Projects Dashboard
 *
 */

//
// TRACKER START/STOP
//

import { CustomApexChart, theme, debounce } from "../app"

const timeDisplay = document.getElementById("tracker-time")
const trackerBtn = document.querySelector(".time-tracker-btn")

if (!timeDisplay || !trackerBtn) {
    console.error("Projects Dashboard: Elements not found.")
}

let timerInterval = null
let isRunning = false

// Convert "HH:MM:SS" → seconds
function timeToSeconds(timeStr) {
    const [h, m, s] = timeStr.split(":").map(Number)
    return h * 3600 + m * 60 + s
}

// Format seconds → "HH:MM:SS"
function formatTime(seconds) {
    const h = String(Math.floor(seconds / 3600)).padStart(2, "0")
    const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0")
    const s = String(seconds % 60).padStart(2, "0")
    return `${h}:${m}:${s}`
}

let currentSeconds = timeToSeconds(timeDisplay.textContent)

// Start / Stop tracker
trackerBtn.addEventListener("click", () => {
    if (!isRunning) {
        // Start
        trackerBtn.textContent = "Stop Tracker"
        trackerBtn.classList.remove("btn-info")
        trackerBtn.classList.add("btn-danger")

        isRunning = true

        timerInterval = setInterval(() => {
            currentSeconds++
            timeDisplay.textContent = formatTime(currentSeconds)
        }, 1000)
    } else {
        // Stop
        trackerBtn.textContent = "Start Tracker"
        trackerBtn.classList.remove("btn-danger")
        trackerBtn.classList.add("btn-info")

        isRunning = false
        clearInterval(timerInterval)
    }
})

//
// Project Status Breakdown
//
new CustomApexChart({
    selector: "#project-status-chart",
    options: () => ({
        chart: {
            height: 341,
            type: "radialBar",
        },
        plotOptions: {
            circle: {
                dataLabels: {
                    showOn: "hover",
                },
            },
            radialBar: {
                track: {
                    margin: 22,
                    background: "rgba(170,184,197, 0.2)",
                },
                hollow: {
                    size: "1%",
                },
                dataLabels: {
                    name: {
                        show: true,
                    },
                    value: {
                        show: true,
                    },
                },
            },
        },
        stroke: {
            lineCap: "round",
        },
        colors: [theme("chart-primary"), theme("chart-gamma"), theme("chart-secondary"), theme("chart-beta")],
        series: [44, 55, 67, 22],
        labels: ["Completed", "In Progress", "Yet to Start", "Cancelled"],
        responsive: [
            {
                breakpoint: 380,
                options: {
                    chart: {
                        height: 260,
                    },
                },
            },
        ],
    }),
})

//
// Projects Performance Overview
//
new CustomApexChart({
    selector: "#dash-projects-overviews",
    options: () => ({
        series: [
            {
                name: "Project Revenue",
                type: "area",
                data: [30, 35, 40, 45, 50, 58, 62, 68, 72, 78, 80, 70], // Jan–Dec
            },
            {
                name: "Project Orders",
                type: "line",
                data: [20, 24, 28, 30, 33, 35, 38, 40, 42, 45, 48, 50], // Jan–Dec
            },
            {
                name: "Project Users",
                type: "bar",
                data: [15, 18, 22, 25, 28, 30, 35, 38, 40, 45, 48, 50], // Jan–Dec
            },
            {
                name: "Active Projects Count",
                type: "bar",
                data: [10, 12, 15, 18, 20, 24, 26, 28, 30, 35, 38, 40], // Jan–Dec
            },
        ],
        chart: {
            type: "line",
            height: 321,
            toolbar: {
                show: false,
            },
            offsetX: 0,
        },
        stroke: {
            width: [2, 2, 0, 0],
            curve: "smooth",
            dashArray: [0, 3, 0, 0],
        },
        colors: [theme("chart-gray"), theme("chart-gamma"), theme("chart-primary"), theme("chart-zeta")],
        grid: {
            strokeDashArray: 1,
        },
        zoom: {
            enabled: false,
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            type: "category",
            axisBorder: {
                show: false,
            },
            labels: {
                offsetY: 1,
            },
        },

        yaxis: {
            min: 0,
            labels: {
                formatter: function (val) {
                    return val + "k"
                },
                offsetX: -10,
            },
            axisBorder: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                borderRadius: 3,
            },
        },
        legend: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        markers: {
            size: 0,
        },
        fill: {
            opacity: [0.2, 1, 1, 1],
        },
        tooltip: {
            y: {
                formatter: function (value, { seriesIndex }) {
                    return "$" + value + "k"
                },
            },
        },
    }),
})
